<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;

class Shippo
{
    public static function trackPackage($trackingNumber) 
    {
        $url = env('SHIPPO_BASE_URL') . '/tracks';
        $header = shippoHeader();

        $response = Http::timeout(120)->withHeaders($header)->post($url, [
            // 'carrier' => 'shippo',
            // 'tracking_number' => 'SHIPPO_TRANSIT'
            'carrier' => 'usps',
            'tracking_number' => $trackingNumber
        ]);

        return $response->json();
    }
}
