<?php

namespace App\Services;

use App\Contracts\PaymentGatewayInterface;
use App\Models\Beneficiary;
use App\Services\BrevoMailService;
use Carbon\Carbon;
use DB;
use Exception;

class SubscriptionCancellationService
{
    protected $gateway;

    public function __construct(PaymentGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function requestCancellation(Beneficiary $beneficiary)
    {
        // 🔍 Plano ativo (local)
        $plan = $beneficiary->plans()
            ->whereNull('end_date')
            ->latest()
            ->first();

        if (!$plan) {
            throw new Exception('Plano ativo não encontrado.');
        }

        // 🔍 Busca a última invoice para identificar o tipo de pagamento e o ID (Agnóstico a Gateway)
        $lastInvoice = $beneficiary->invoices()
            ->orderByDesc('created_at')
            ->first();

        if (!$lastInvoice) {
             throw new Exception('Nenhuma fatura encontrada para este beneficiário.');
        }

        $paymentId = $lastInvoice->asaas_payment_id; // Campo onde o ID do gateway está armazenado
        $isCreditCard = ($lastInvoice->payment_type === 'CREDIT_CARD');
        
        // 📅 Calcula fim do período pago
        // 🔍 Última invoice paga (pay_...)
        $lastPaidInvoice = $beneficiary->invoices()
            ->whereIn('status', ['CONFIRMED', 'RECEIVED', 'AUTHORIZED'])
            ->orderByDesc('payment_date')
            ->first();

        if ($lastPaidInvoice != null) {
            $endDate = Carbon::parse($lastPaidInvoice->due_date ?? $lastPaidInvoice->created_at)
                ->addMonth()
                ->subDay()
                ->toDateString();
        } else {
            $endDate = Carbon::parse(now())->toDateString();
        }

        // Logo base64
        $logo = asset('material/img/logo.png');

        // HTML do email
        $html = view('emails.cancelService', [
            'name'     => $beneficiary->name,
            'logo'     => $logo,
        ])->render();

        BrevoMailService::send(
            $beneficiary->email,
            'Plano cancelado',
            $html
        );

        DB::transaction(function () use ($paymentId, $plan, $endDate, $isCreditCard) {
            // ❌ Se for Crédito, cancela a recorrência no Gateway ativo
            if ($isCreditCard && $paymentId) {
                $this->gateway->cancelSubscription($paymentId);
            }

            // 📅 Mantém acesso até o fim do ciclo (bloqueia o motor de débito externo)
            $plan->update([
                'end_date' => $endDate
            ]);
        });
    }
}
