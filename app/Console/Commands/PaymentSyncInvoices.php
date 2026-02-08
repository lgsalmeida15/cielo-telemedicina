<?php

namespace App\Console\Commands;

use DB;
use Exception;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Financial;
use App\Models\Beneficiary;
use App\Models\InvoiceHistory;
use Illuminate\Console\Command;
use App\Models\BeneficiaryPlan;
use App\Contracts\PaymentGatewayInterface;
use App\Services\Payment\AsaasAdapter;
use App\Services\Payment\CieloAdapter;

class PaymentSyncInvoices extends Command
{
    protected $signature = 'payment:sync-invoices 
                            {--company= : ID da empresa (opcional)}
                            {--days=30 : Buscar cobranças dos últimos X dias}';

    protected $description = 'Sincroniza cobranças dos Gateways (Asaas/Cielo) com Invoices, histórico e financeiro';

    public function handle()
    {
        $this->info('🔄 Iniciando sincronização de cobranças multi-gateway');

        $days = (int) $this->option('days');
        $companyId = $this->option('company');

        // 1. Sincronização via Listagem (Asaas mantém o fluxo antigo por lote)
        $this->syncAsaasBatch($days, $companyId);

        // 2. Sincronização por Verificação Individual (Para Invoices PENDENTES de qualquer gateway)
        $this->syncPendingInvoices($companyId);

        $this->info('✅ Sincronização finalizada');
        return Command::SUCCESS;
    }

    /**
     * Sincroniza faturas pendentes individualmente consultando o gateway de cada uma
     */
    protected function syncPendingInvoices($companyId)
    {
        $this->info('🔍 Verificando invoices pendentes individualmente...');

        $pendingInvoices = Invoice::whereIn('status', ['PENDING', 'AWAITING_PAYMENT', 'AUTHORIZED'])
            ->when($companyId, function($q) use ($companyId) {
                return $q->whereHas('beneficiary', fn($b) => $b->where('company_id', $companyId));
            })
            ->get();

        foreach ($pendingInvoices as $invoice) {
            try {
                // Resolve o gateway da invoice
                $gateway = $this->resolveGateway($invoice->payment_gateway);
                $paymentData = $gateway->getPaymentStatus($invoice->asaas_payment_id);

                if ($paymentData) {
                    $this->syncSinglePayment($paymentData, $invoice->payment_gateway, $companyId);
                }
            } catch (Exception $e) {
                $this->error("❌ Erro ao sincronizar invoice {$invoice->asaas_payment_id}: " . $e->getMessage());
            }
        }
    }

    /**
     * Resolve qual adaptador usar baseado no nome do gateway
     */
    protected function resolveGateway($gatewayName)
    {
        if ($gatewayName === 'cielo') {
            return app(CieloAdapter::class);
        }
        return app(AsaasAdapter::class);
    }

    /**
     * Mantém a compatibilidade com a busca em lote do Asaas
     */
    protected function syncAsaasBatch($days, $companyId)
    {
        $this->info('📦 Buscando lote de pagamentos recentes no Asaas...');
        $asaasAdapter = app(AsaasAdapter::class);
        $asaasService = app(\App\Services\Asaas\AsaasService::class);
        
        $offset = 0;
        $limit = 100;

        try {
            do {
                $response = $asaasService->getPayments([
                    'offset' => $offset,
                    'limit' => $limit,
                    'dateCreated[ge]' => now()->subDays($days)->format('Y-m-d')
                ]);

                foreach ($response['data'] as $payment) {
                    $this->syncSinglePayment($payment, 'asaas', $companyId);
                }

                $offset += $limit;
            } while ($response['hasMore']);
        } catch (Exception $e) {
            $this->error('❌ Erro no lote Asaas: ' . $e->getMessage());
        }
    }

    /**
     * 🔄 Sincroniza um pagamento genérico
     */
    protected function syncSinglePayment(array $payment, string $gatewayName, ?int $companyId = null)
    {
        // No Asaas o campo é 'customer', no nosso mapeamento genérico também
        $customerId = $payment['customer'];
        $paymentId = $payment['id'] ?? $payment['PaymentId'] ?? null;

        $beneficiary = Beneficiary::where(function($q) use ($customerId) {
                $q->where('asaas_customer_id', $customerId)
                  ->orWhere('cpf', $customerId); // Para Cielo usamos CPF como fallback
            })
            ->when($companyId, fn($q) => $q->where('company_id', $companyId))
            ->first();

        if (!$beneficiary) {
            return;
        }

        DB::transaction(function () use ($payment, $beneficiary, $gatewayName, $paymentId) {
            $dueDate = Carbon::parse($payment['dueDate'] ?? now());
            $newStatus = $payment['status'];

            $beneficiaryPlan = $beneficiary->activePlanAt($dueDate);
            if (!$beneficiaryPlan) return;

            // 📄 Cria ou atualiza Invoice
            $invoice = $this->updateLocalInvoice(
                $payment,
                $beneficiary,
                $beneficiaryPlan,
                $dueDate,
                $newStatus,
                $gatewayName
            );

            // 💰 Financeiro
            if (!$this->shouldIgnoreFinancial($paymentId)) {
                $this->syncFinancial($payment, $invoice, $beneficiary, $beneficiaryPlan, $newStatus);
            }
        });

        $this->line("✔ [{$gatewayName}] Invoice sincronizada: {$paymentId} ({$payment['status']})");
    }

    protected function updateLocalInvoice($payment, $beneficiary, $beneficiaryPlan, $dueDate, $newStatus, $gatewayName)
    {
        $paymentId = $payment['id'] ?? $payment['PaymentId'] ?? null;
        $invoice = Invoice::where('asaas_payment_id', $paymentId)->first();

        if (!$invoice) {
            $invoice = Invoice::create([
                'asaas_payment_id'    => $paymentId,
                'payment_gateway'     => $gatewayName,
                'beneficiary_id'      => $beneficiary->id,
                'beneficiary_plan_id' => $beneficiaryPlan->id,
                'competence_month'    => $dueDate->month,
                'competence_year'     => $dueDate->year,
                'invoice_value'       => $payment['value'] ?? ($payment['Amount'] / 100),
                'status'              => $newStatus,
                'due_date'            => $dueDate,
                'payment_type'        => $payment['billingType'] ?? 'CREDIT_CARD',
                'payment_date'        => $payment['paymentDate'] ?? null,
            ]);
        } else {
            if ($invoice->status !== $newStatus) {
                $invoice->update([
                    'status'       => $newStatus,
                    'payment_date' => $payment['paymentDate'] ?? $invoice->payment_date,
                ]);
            }
        }

        return $invoice;
    }

    protected function shouldIgnoreFinancial($paymentId): bool
    {
        if (!$paymentId) return true;
        // Se começar com sub_ (Asaas), ignora lançamento financeiro da assinatura, espera os pay_
        return str_starts_with($paymentId, 'sub_');
    }

    protected function syncFinancial($payment, $invoice, $beneficiary, $beneficiaryPlan, $status): void
    {
        $paidStatuses = ['RECEIVED', 'CONFIRMED', 'CAPTURED'];
        if (!in_array($status, $paidStatuses)) return;

        $paymentId = $payment['id'] ?? $payment['PaymentId'] ?? null;

        Financial::updateOrCreate(
            ['asaas_payment_id' => $paymentId],
            [
                'invoice_id'       => $invoice->id,
                'data_hora_evento' => Carbon::parse($payment['paymentDate'] ?? now()),
                'tipo'             => 'entrada',
                'valor'            => $payment['value'] ?? ($payment['Amount'] / 100),
                'caixa_id'         => 1,
                'user_id'          => 1,
                'cost_center_id'   => 1,
                'descricao'        => "PAGAMENTO {$invoice->payment_gateway} - {$beneficiary->name}"
            ]
        );
    }
}
