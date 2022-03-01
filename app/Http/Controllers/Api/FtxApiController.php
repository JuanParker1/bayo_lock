<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ApiServices;
use Illuminate\Support\Facades\Http;

class FtxApiController extends Controller
{
    public function index($path)
    {
        $apiService = new ApiServices(config('ftx.ApiSecretKey'));

        $timestamp = $apiService->getMillisecondsTimestamp();
        $result = '';
        switch ($path) {
            case 'order-history':
                $path = config('ftx.urls.order-history.url');
                $methode = strtoupper(config('ftx.urls.order-history.methode'));
                $url = config('ftx.url') . $path;

                $result = $this->getOrderHistory(
                    $url,
                    $timestamp,
                    $apiService->createSignature(
                        "{$timestamp}{$methode}{$path}"
                    )
                );
        }

        // handle result!
    }

    public function getOrderHistory($url, $timestamp, $signature)
    {
        return Http::withHeaders([
            'FTX-KEY' => config('ftx.ApiKey'),
            'FTX-SIGN' => $signature,
            'FTX-TS' => strval($timestamp)
        ])->get($url);
    }
}
