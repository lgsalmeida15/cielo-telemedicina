<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\PaymentGatewayInterface;
use Illuminate\Http\JsonResponse;
use Exception;

class Cielo3DSController extends Controller
{
    protected PaymentGatewayInterface $gateway;

    public function __construct(PaymentGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Retorna o Access Token para o script 3DS da Cielo
     *
     * @return JsonResponse
     */
    public function getAccessToken(): JsonResponse
    {
        try {
            // Verifica se o gateway atual é Cielo
            if (!method_exists($this->gateway, 'getAccessToken')) {
                return response()->json(['error' => 'Gateway atual não suporta 3DS'], 400);
            }

            $tokenData = $this->gateway->getAccessToken();

            return response()->json($tokenData);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
