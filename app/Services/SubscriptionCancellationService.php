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

        // 🔍 Invoice que contém o ID da assinatura (sub_...)
        $subscriptionInvoice = $beneficiary->invoices()
            ->where('asaas_payment_id', 'like', 'sub_%')
            ->orderByDesc('created_at')
            ->first();

        if (!$subscriptionInvoice) {
             throw new Exception('Assinatura não encontrada para este beneficiário.');
        }

        $subscriptionId = $subscriptionInvoice->asaas_payment_id;
        
        // 🔍 Última invoice paga (pay_...)
        $lastPaidInvoice = $beneficiary->invoices()
            ->whereIn('status', ['CONFIRMED', 'RECEIVED'])
            ->where('asaas_payment_id', 'like', 'pay_%')
            ->orderByDesc('payment_date')
            ->first();

        // 📅 Calcula fim do período pago
        if ($lastPaidInvoice != null) {
            $endDate = Carbon::parse($lastPaidInvoice->due_date)
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

        DB::transaction(function () use ($subscriptionId, $plan, $endDate) {
            // ❌ Cancela assinatura no Gateway
            $this->gateway->cancelSubscription($subscriptionId);

            // 📅 Mantém acesso até o fim do ciclo
            $plan->update([
                'end_date' => $endDate
            ]);
        });
    }
}
