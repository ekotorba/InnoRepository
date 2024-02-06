<?php

namespace App\Client;

use App\Config\NBPConfig;
use GuzzleHttp\Client;

class NBPClient
{
    public function __construct(private NBPConfig $NBPConfig){}

    public function fetchNBPApi(): array
    {
        $NBPClient = new Client();
        $response = $NBPClient->request('GET', $this->NBPConfig->getBaseApiURL() . '/exchangerates/tables/A');
        $jsonDecode = json_decode($response->getBody()->getContents(), true);
        return $jsonDecode[0]['rates'];
    }
}
