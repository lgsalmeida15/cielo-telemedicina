<?php

namespace App\Services;

use App\Models\Invoice;
use App\Services\InvoiceHistoryService;

class InvoiceService
{
    public function createInvoice($beneficiary, $beneficiaryPlan, $payment, $request)
    {
        try {

            // Detecta se é ASSINATURA ou PAGAMENTO
            $isSubscription = isset($payment['object']) && $payment['object'] === 'subscription'
                || isset($payment['nextDueDate']);

            // Mapeamento dos campos dependendo do tipo
            if ($isSubscription) {
                // ASSINATURA (CREDIT_CARD)
                $asaasId   = $payment['id'] ?? null;
                $value     = $payment['value'] ?? 0;
                $status    = $payment['status'] ?? 'PENDING';
                $dueDate   = $payment['nextDueDate'] ?? now()->format('Y-m-d');  // assinatura usa nextDueDate
            } else {
                // PAGAMENTO (PIX/BOLETO)
                $asaasId   = $payment['id'] ?? null;
                $value     = $payment['value'] ?? 0;
                $status    = $payment['status'] ?? 'PENDING';
                $dueDate   = $payment['dueDate'] ?? now()->format('Y-m-d'); // pagamento usa dueDate
            }

            // Fallback de valor caso o gateway não retorne
            if ($value <= 0 && isset($beneficiaryPlan->plan->value)) {
                $value = $beneficiaryPlan->plan->value;
            }

            // Cria invoice
            $invoice = Invoice::create([
                'beneficiary_plan_id' => $beneficiaryPlan->id,
                'beneficiary_id'      => $beneficiary->id,
                'asaas_payment_id'    => $asaasId,
                'payment_gateway'     => config('services.payment_gateway.driver', 'asaas'),
                'competence_month'    => now()->format('m'),
                'competence_year'     => now()->format('Y'),
                'invoice_value'       => $value,
                'status'              => $status,
                'due_date'            => $dueDate,
                'payment_type'        => $request->payment_type,
                'payment_date'        => null,
            ]);

            // cria histórico inicial
            app(InvoiceHistoryService::class)
                ->createInvoiceHistory($invoice);

            return $invoice;

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
