<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;
use Illuminate\Support\Facades\Http;
use Exception;

class CieloAdapter implements PaymentGatewayInterface
{
    protected string $baseUrl;
    protected string $merchantId;
    protected string $merchantKey;
    protected string $clientId;
    protected string $clientSecret;
    protected bool $use3ds;

    public function __construct()
    {
        $this->baseUrl = config('services.payment_gateway.cielo.url');
        $this->merchantId = config('services.payment_gateway.cielo.merchant_id');
        $this->merchantKey = config('services.payment_gateway.cielo.merchant_key');
        $this->clientId = config('services.payment_gateway.cielo.client_id');
        $this->clientSecret = config('services.payment_gateway.cielo.client_secret');
        $this->use3ds = config('services.payment_gateway.cielo.use_3ds', false);
    }

    /**
     * Obtém o Access Token OAuth para o script 3DS
     */
    public function getAccessToken()
    {
        $authUrl = str_contains($this->baseUrl, 'sandbox') 
            ? 'https://mpisandbox.braspag.com.br/v2/auth/token' 
            : 'https://mpi.braspag.com.br/v2/auth/token';

        $auth = base64_encode("{$this->clientId}:{$this->clientSecret}");

        $response = Http::withHeaders([
            'Authorization' => "Basic {$auth}",
            'Content-Type' => 'application/json',
        ])->post($authUrl, [
            'EstablishmentCode' => config('services.payment_gateway.cielo.establishment_code'),
            'MerchantName' => config('services.payment_gateway.cielo.merchant_name'),
            'MCC' => config('services.payment_gateway.cielo.mcc'),
        ]);

        if (!$response->successful()) {
            throw new Exception("Erro ao obter Access Token Cielo: " . $response->body());
        }

        return $response->json();
    }

    public function createCustomer($beneficiary)
    {
        // Na Cielo, o customer pode ser enviado junto com a venda.
        // Retornamos null para indicar que não há um ID prévio necessário.
        return null;
    }

    public function createPayment($beneficiary, $planUuid, $paymentType)
    {
        // Implementação futura para Pix/Boleto na Cielo se necessário
        throw new Exception("Método de pagamento {$paymentType} ainda não implementado para Cielo.");
    }

    public function createSubscription($customerGatewayId, $value, $description, $creditCard, $holderInfo)
    {
        // Cielo espera o valor em centavos (Ex: 157.00 -> 15700)
        $amount = (int) ($value * 100);

        // Formata a data de expiração de MM e YYYY para MM/YYYY
        $expirationDate = str_pad($creditCard['expiryMonth'] ?? $creditCard['card_month'], 2, '0', STR_PAD_LEFT) . '/' . ($creditCard['expiryYear'] ?? $creditCard['card_year']);

        $paymentType = request('payment_type') === 'DEBIT_CARD' ? 'DebitCard' : 'CreditCard';
        $cardKey = $paymentType === 'DebitCard' ? 'DebitCard' : 'CreditCard';
        $brand = $this->detectCardBrand($creditCard['number'] ?? $creditCard['card_number']);

        $payload = [
            "MerchantOrderId" => uniqid("ORDER_"),
            "Customer" => [
                "Name" => $holderInfo['name'],
                "Identity" => preg_replace('/\D/', '', $holderInfo['cpfCnpj']),
                "IdentityType" => "CPF",
                "Email" => $holderInfo['email']
            ],
            "Payment" => [
                "Type" => $paymentType,
                "Amount" => $amount,
                "Installments" => 1,
                "SoftDescriptor" => substr($description, 0, 13),
                "Capture" => true,
                "Recurrent" => true,
                "RecurrentPayment" => [
                    "AuthorizeNow" => true,
                    "Interval" => "Monthly"
                ],
                $cardKey => [
                    "CardNumber" => preg_replace('/\D/', '', $creditCard['number'] ?? $creditCard['card_number']),
                    "Holder" => $creditCard['holderName'] ?? $creditCard['card_holder'],
                    "ExpirationDate" => $expirationDate,
                    "SecurityCode" => $creditCard['ccv'],
                    "SaveCard" => true,
                    "Brand" => $brand
                ]
            ]
        ];

        // Configurações específicas para Braspag v2 / Débito / 3DS
        if ($this->use3ds && ($paymentType === 'DebitCard' || request('cielo_3ds_eci'))) {
            $payload['Payment']['Authenticate'] = true;
        }

        // Se houver dados de autenticação 3DS vindos do checkout (e o 3DS estiver habilitado)
        if ($this->use3ds && request('cielo_3ds_eci')) {
            $payload['Payment']['ExternalAuthentication'] = [
                "Cavv" => request('cielo_3ds_cavv'),
                "Xid" => request('cielo_3ds_xid'),
                "Eci" => request('cielo_3ds_eci'),
                "Version" => request('cielo_3ds_version'),
                "ReferenceId" => request('cielo_3ds_reference_id')
            ];
        }

        // Regra Elo 2025 (Obrigatório para Link de Pagamento/External)
        if ($brand === 'Elo') {
            $payload['Payment']['SolutionType'] = "ExternalLinkPay";
        }

        // Provedor Simulado para Sandbox Braspag
        if (str_contains($this->baseUrl, 'sandbox')) {
            $payload['Payment']['Provider'] = "Simulado";
        }

        $response = Http::withHeaders([
            'MerchantId' => $this->merchantId,
            'MerchantKey' => $this->merchantKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/v2/sales', $payload);

        if (!$response->successful()) {
            throw new Exception("Erro Cielo: " . ($response->json()['Message'] ?? $response->body()));
        }

        $data = $response->json();

        // Mapeamos o retorno para um formato compatível com o que o InvoiceService espera
        return [
            'id' => $data['Payment']['PaymentId'] ?? null,
            'status' => $this->translateStatus($data['Payment']['Status'] ?? null),
            'value' => $value, // valor em decimal
            'billingType' => 'CREDIT_CARD',
            'nextDueDate' => now()->format('Y-m-d'), // Cielo captura na hora
            'raw_response' => $data
        ];
    }

    public function cancelSubscription($subscriptionId)
    {
        // Implementação de cancelamento Cielo (Put /1/sales/{PaymentId}/void)
        throw new Exception("Cancelamento ainda não implementado para Cielo.");
    }

    public function updateSubscriptionCreditCard($subscriptionId, $creditCard, $holderInfo, $remoteIp)
    {
        throw new Exception("Atualização de cartão ainda não implementada para Cielo.");
    }

    public function getPaymentStatus($paymentId)
    {
        $queryUrl = config('services.payment_gateway.cielo.query_url');

        $response = Http::withHeaders([
            'MerchantId' => $this->merchantId,
            'MerchantKey' => $this->merchantKey,
            'Content-Type' => 'application/json',
        ])->get($queryUrl . "/v2/sales/{$paymentId}");

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();
        $payment = $data['Payment'] ?? null;

        if (!$payment) {
            return null;
        }

        // Mapeamento de status Cielo para um formato comum (ou manter o original se preferir)
        // Cielo Status: 1 (Autorizado), 2 (Capturado), etc.
        return [
            'id' => $payment['PaymentId'],
            'status' => $this->translateStatus($payment['Status']),
            'value' => $payment['Amount'] / 100, // Volta para decimal
            'billingType' => $payment['Type'],
            'paymentDate' => $payment['ReceivedDate'] ?? null,
            'dueDate' => $payment['ReceivedDate'] ?? null, // Cielo não tem due_date igual Asaas para cartão
            'description' => $data['MerchantOrderId'] ?? '',
            'customer' => $data['Customer']['Identity'] ?? ''
        ];
    }

    private function translateStatus($status)
    {
        $map = [
            1 => 'AUTHORIZED',
            2 => 'CONFIRMED', // Capturado
            3 => 'DENIED',
            10 => 'VOIDED',
            11 => 'REFUNDED',
            12 => 'PENDING',
        ];

        return $map[$status] ?? 'UNKNOWN';
    }

    /**
     * Detecta a bandeira do cartão (Simples)
     */
    private function detectCardBrand($number)
    {
        $number = preg_replace('/\D/', '', $number);
        if (preg_match('/^4/', $number)) return 'Visa';
        if (preg_match('/^5[1-5]/', $number)) return 'Master';
        // Adicionar lógica ELO se necessário, embora o controller já valide
        return 'Elo'; 
    }
}
