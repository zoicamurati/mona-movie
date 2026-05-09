<?php

return [
    'mode' => env('PAYPAL_MODE', 'sandbox'), // 'sandbox' or 'live'

    'sandbox' => [
        'client_id'     => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
    ],

    'live' => [
        'client_id'     => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'capture'),
    'currency'       => env('PAYPAL_CURRENCY', 'EUR'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''),
    'locale'         => env('PAYPAL_LOCALE', 'en_US'),
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true),
    'invoice_prefix' => env('PAYPAL_INVOICE_PREFIX', 'PAYPALDEMOAPP'),
];
