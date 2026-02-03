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
use App\Services\Asaas\AsaasService;

class AsaasSyncInvoices extends Command
{
    protected $signature = 'asaas:sync-invoices 
                            {--company= : ID da empresa (opcional)}
                            {--days=30 : Buscar cobranças dos últimos X dias}';

    protected $description = 'Sincroniza cobranças do Asaas com Invoices, histórico e financeiro';

    public function handle()
    {
        $this->info('🔄 Iniciando sincronização de cobranças Asaas');

        $asaas = app(AsaasService::class);
        $days = (int) $this->option('days');
        $companyId = $this->option('company');

        $offset = 0;
        $limit = 100;

        try {
            do {
                $response = $asaas->getPayments([
                    'offset' => $offset,
                    'limit' => $limit,
                    'dateCreated[ge]' => now()->subDays($days)->format('Y-m-d')
                ]);

                foreach ($response['data'] as $payment) {
                    $this->syncPayment($payment, $companyId);
                }

                $offset += $limit;

            } while ($response['hasMore']);

            $this->info('✅ Sincronização finalizada');
            return Command::SUCCESS;

        } catch (Exception $e) {
            $this->error('❌ Erro: ' . $e->getMessage());
            report($e);
            return Command::FAILURE;
        }
    }

    /**
     * 🔄 Sincroniza um pagamento do Asaas
     */
    protected function syncPayment(array $payment, ?int $companyId = null)
    {
        $beneficiary = Beneficiary::where('asaas_customer_id', $payment['customer'])
            ->when($companyId, fn($q) => $q->where('company_id', $companyId))
            ->first();

        if (!$beneficiary) {
            $this->warn("⚠ Beneficiário não encontrado: {$payment['customer']}");
            return;
        }

        DB::transaction(function () use ($payment, $beneficiary) {

            $dueDate   = Carbon::parse($payment['dueDate']);
            $newStatus = $payment['status'];

            // 🔧 Corrige planos sem start_date
            $this->fixBeneficiaryPlans($beneficiary);

            // 🔍 Plano ativo na data
            $beneficiaryPlan = $beneficiary->activePlanAt($dueDate);

            if (!$beneficiaryPlan) {
                logger()->warning('Invoice ignorada: sem plano ativo', [
                    'asaas_payment_id' => $payment['id'],
                    'beneficiary_id'   => $beneficiary->id,
                ]);
                return;
            }

            // 📄 Cria ou atualiza Invoice
            $invoice = $this->syncInvoice(
                $payment,
                $beneficiary,
                $beneficiaryPlan,
                $dueDate,
                $newStatus
            );

            // 💰 Lançamento financeiro (somente pay_)
            if (!$this->shouldIgnoreFinancial($payment)) {
                $this->syncFinancial(
                    $payment,
                    $invoice,
                    $beneficiary,
                    $beneficiaryPlan,
                    $newStatus
                );
            }
        });

        $this->line("✔ Invoice sincronizada: {$payment['id']} ({$payment['status']})");
    }

    /**
     * 🔧 Corrige planos sem data inicial
     */
    protected function fixBeneficiaryPlans(Beneficiary $beneficiary): void
    {
        BeneficiaryPlan::where('beneficiary_id', $beneficiary->id)
            ->whereNull('start_date')
            ->each(function ($plan) {
                $plan->update([
                    'start_date' => $plan->created_at->toDateString()
                ]);
            });
    }

    /**
     * 📄 Cria ou atualiza Invoice e Histórico
     */
    protected function syncInvoice(
        array $payment,
        Beneficiary $beneficiary,
        BeneficiaryPlan $beneficiaryPlan,
        Carbon $dueDate,
        string $newStatus
    ): Invoice {
        $invoice = Invoice::where('asaas_payment_id', $payment['id'])->first();

        if (!$invoice) {

            $invoice = Invoice::create([
                'asaas_payment_id'    => $payment['id'],
                'beneficiary_id'      => $beneficiary->id,
                'beneficiary_plan_id' => $beneficiaryPlan->id,
                'competence_month'    => $dueDate->month,
                'competence_year'     => $dueDate->year,
                'invoice_value'       => $payment['value'],
                'status'              => $newStatus,
                'due_date'            => $payment['dueDate'],
                'payment_type'        => $payment['billingType'],
                'payment_date'        => $payment['paymentDate'] ?? null,
            ]);

            InvoiceHistory::create([
                'invoice_id'         => $invoice->id,
                'transaction_code'   => $payment['id'],
                'status_transaction' => $newStatus,
                'return_code'        => $newStatus,
                'return_message'     => $payment['description'] ?? 'Criação via sync Asaas'
            ]);

            return $invoice;
        }

        // 🔁 Atualização
        if ($invoice->status !== $newStatus) {
            $invoice->update([
                'status'       => $newStatus,
                'payment_date' => $payment['paymentDate'] ?? $invoice->payment_date,
            ]);

            InvoiceHistory::firstOrCreate(
                [
                    'invoice_id'         => $invoice->id,
                    'status_transaction' => $newStatus,
                ],
                [
                    'transaction_code' => $payment['id'],
                    'return_code'      => $newStatus,
                    'return_message'   => $payment['description'] ?? 'Atualização via sync Asaas'
                ]
            );
        }

        return $invoice;
    }

    /**
     * 🚫 Regra do Financeiro
     * Ignora assinaturas (sub_) e aceita apenas pagamentos (pay_)
     */
    protected function shouldIgnoreFinancial(array $payment): bool
    {
        return str_starts_with($payment['id'], 'sub_')
            || !str_starts_with($payment['id'], 'pay_');
    }

    /**
     * 💰 Cria ou atualiza lançamento financeiro
     */
    protected function syncFinancial(
        array $payment,
        Invoice $invoice,
        Beneficiary $beneficiary,
        BeneficiaryPlan $beneficiaryPlan,
        string $status
    ): void {
        $paidStatuses = ['RECEIVED', 'CONFIRMED'];

        if (!in_array($status, $paidStatuses)) {
            return;
        }

        Financial::updateOrCreate(
            [
                'asaas_payment_id' => $payment['id'],
            ],
            [
                'invoice_id'       => $invoice->id,
                'data_hora_evento' => Carbon::parse($payment['paymentDate'] ?? now()),
                'tipo'             => 'entrada',
                'descricao'        => sprintf(
                    'ENTRADA - CLIENTE: %s - PLANO: %s (R$ %.2f)',
                    $beneficiary->name,
                    $beneficiaryPlan->plan->name ?? 'Plano',
                    $payment['value']
                ),
                'valor'            => $payment['value'],
                'cost_center_id'   => 1,
                'user_id'          => 1,
                'caixa_id'         => 1,
            ]
        );
    }
}
