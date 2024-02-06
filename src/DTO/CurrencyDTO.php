<?php

namespace App\DTO;

class CurrencyDTO
{
    public readonly string $currencyName;
    public readonly string $currencyCode;
    public readonly string $exchangeRate;

    public function __construct(string $currencyName, string $currencyCode, string $exchangeRate)
    {
        $this->currencyName = $currencyName;
        $this->currencyCode = $currencyCode;
        $this->exchangeRate = $exchangeRate;
    }

    public function toArray()
    {
        return [
            'currencyName' => $this->currencyName,
            'currencyCode' => $this->currencyCode,
            'exchangeRate' => $this->exchangeRate,
        ];
    }
}

