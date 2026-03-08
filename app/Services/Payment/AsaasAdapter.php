<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;
use App\Services\AsaasPaymentService;
use App\Services\AsaasCustomerService;
use App\Services\Asaas\AsaasService;

class AsaasAdapter implements PaymentGatewayInterface
{
    protected $paymentService;
    protected $customerService;
    protected $asaasService;

    public function __construct(
        AsaasPaymentService $paymentService,
        AsaasCustomerService $customerService,
        AsaasService $asaasService
    ) {
        $this->paymentService = $paymentService;
        $this->customerService = $customerService;
        $this->asaasService = $asaasService;
    }

    public function createCustomer($beneficiary)
    {
        return $this->customerService->createCustomerForBeneficiary($beneficiary);
    }

    public function createPayment($beneficiary, $planUuid, $paymentType)
    {
        return $this->paymentService->createPayment($beneficiary, $planUuid, $paymentType);
    }

    public function createSubscription($customerGatewayId, $value, $description, $creditCard, $holderInfo)
    {
        return $this->paymentService->createSubscription(
            $customerGatewayId,
            $value,
            $description,
            $creditCard,
            $holderInfo
        );
    }

    public function cancelSubscription($subscriptionId)
    {
        return $this->asaasService->cancelSubscription($subscriptionId);
    }

    public function updateSubscriptionCreditCard($subscriptionId, $creditCard, $holderInfo, $remoteIp)
    {
        return $this->asaasService->updateSubscriptionCreditCard(
            $subscriptionId,
            $creditCard,
            $holderInfo,
            $remoteIp
        );
    }

    public function getPaymentStatus($paymentId)
    {
        // O AsaasAdapter pode usar o AsaasService para buscar os pagamentos
        // Aqui simplificamos buscando o pagamento individual
        $response = $this->asaasService->getPayments(['id' => $paymentId]);
        
        if (isset($response['data'][0])) {
            $payment = $response['data'][0];
            return [
                'id' => $payment['id'],
                'status' => $payment['status'],
                'value' => $payment['value'],
                'billingType' => $payment['billingType'],
                'paymentDate' => $payment['paymentDate'] ?? null,
                'dueDate' => $payment['dueDate'],
                'description' => $payment['description'] ?? '',
                'customer' => $payment['customer']
            ];
        }

        return null;
    }

    public function getSubscriptionStatus($subscriptionId)
    {
        // No Asaas, a assinatura pode ser consultada via AsaasService
        // Implementação básica para manter a interface
        return $this->asaasService->getSubscription($subscriptionId);
    }
}
