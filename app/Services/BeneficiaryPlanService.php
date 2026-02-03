<?php

namespace App\Services;

use App\Models\BeneficiaryPlan;
use App\Models\Plan;
use App\Models\Invoice;

class BeneficiaryPlanService
{
    public function createBeneficiaryPlan($beneficiary, $planUuid)
    {
        try {
            $plan = Plan::where('uuid', $planUuid)->firstOrFail();

            // procura se já existe relação beneficiário-plano
            $existing = BeneficiaryPlan::where('beneficiary_id', $beneficiary->id)
                ->where('plan_id', $plan->id)
                ->whereNull('end_date')
                ->first();

            if ($existing) {

                // 🔎 verifica se existe invoice ativa (pendente ou paga)
                $hasActiveInvoice = Invoice::where('beneficiary_plan_id', $existing->id)
                    ->whereIn('status', ['paid'])
                    ->exists();

                if ($hasActiveInvoice) {
                    throw new \Exception("O beneficiário já possui este plano ativo.");
                }

                // ✔ Não existe invoice ativa → retorna o existente
                // permite nova tentativa de pagamento
                return $existing;
            }

            // ✔ cria novo relacionamento
            $beneficiaryPlan = BeneficiaryPlan::create([
                'beneficiary_id' => $beneficiary->id,
                'plan_id' => $plan->id,
            ]);

            return $beneficiaryPlan;

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
