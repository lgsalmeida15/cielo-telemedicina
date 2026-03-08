<?php

namespace App\Contracts;

interface PaymentGatewayInterface
{
    /**
     * Cria ou recupera um cliente no gateway.
     */
    public function createCustomer($beneficiary);
    
    /**
     * Cria um pagamento avulso (Pix ou Boleto).
     */
    public function createPayment($beneficiary, $planUuid, $paymentType);
    
    /**
     * Cria uma assinatura recorrente (Cartão de Crédito/Débito).
     */
    public function createSubscription($customerGatewayId, $value, $description, $creditCard, $holderInfo);
    
    /**
     * Cancela uma assinatura existente.
     */
    public function cancelSubscription($subscriptionId);

    /**
     * Atualiza o cartão de crédito de uma assinatura.
     */
    public function updateSubscriptionCreditCard($subscriptionId, $creditCard, $holderInfo, $remoteIp);

    /**
     * Consulta o status de um pagamento no gateway.
     */
    public function getPaymentStatus($paymentId);

    /**
     * Consulta uma recorrência/assinatura no gateway.
     */
    public function getSubscriptionStatus($subscriptionId);
}
