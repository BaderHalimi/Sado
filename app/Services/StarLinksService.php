<?php
// app/Services/StarLinksService.php
// app/Services/StarLinksService.php

namespace App\Services;

use GuzzleHttp\Client;

class StarLinksService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.starlinks.api_key'); // ضع API Key في ملف config/services.php
    }

    public function createShipment($shipmentDetails)
    {
        $response = $this->client->post('https://starlinksapi.app/api/v1/shipments', [
            'json' => $shipmentDetails,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function trackShipment($trackingNumber)
    {
        $response = $this->client->get("https://starlinksapi.app/api/v1/shipments/track/{$trackingNumber}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}

