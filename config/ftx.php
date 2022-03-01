<?php

return [
    'url' => 'https://ftx.com',
    'ApiKey' => env('FTX_API_KEY'),
    'ApiSecretKey' => env('FTX_API_SECRET_KEY'),
    'urls' => [
        'order-history' => [
            'url' => '/api/orders/history',
            'methode' => 'GET'
        ]
    ]
];
