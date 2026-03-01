<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'brevo' => [
        'key' => env('BREVO_API_KEY'),
    ],

    'payment_gateway' => [
        'driver' => env('PAYMENT_GATEWAY_DRIVER', 'asaas'),
        'asaas' => [
            'url' => env('ASAAS_URL', 'https://sandbox.asaas.com/api/v3'),
            'key' => env('ASAAS_TOKEN'),
        ],
        'cielo' => [
            'url' => env('GATEWAY_URL'),
            'query_url' => env('GATEWAY_QUERY_URL'),
            'merchant_id' => env('GATEWAY_MERCHANT_ID'),
            'merchant_key' => env('GATEWAY_MERCHANT_KEY'),
            'client_id' => env('CIELO_CLIENTID'),
            'client_secret' => env('CIELO_CLIENTSECRET'),
            'establishment_code' => env('CIELO_ESTABLISHMENT_CODE', '1006993069'),
            'merchant_name' => env('CIELO_MERCHANT_NAME', 'BoxFarma'),
            'mcc' => env('CIELO_MCC', '5912'),
            'use_3ds' => env('3DS') === 'SIM',
        ],
    ],


];
