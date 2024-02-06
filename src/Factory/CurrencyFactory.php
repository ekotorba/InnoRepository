<?php

namespace App\Factory;

use App\DTO\CurrencyDTO;
use App\Entity\Currency;
use JetBrains\PhpStorm\Pure;

class CurrencyFactory
{
    #[Pure]
    public static function build(array $currency): CurrencyDTO
    {
        return new CurrencyDTO(
            currencyName: $currency['currency'],
            currencyCode: $currency['code'],
            exchangeRate: $currency['mid']
        );
    }

    #[Pure]
    public function buildFromModel(Currency $currency): CurrencyDTO
    {
        return new CurrencyDTO(
            currencyName: $currency->getCurrencyName(),
            currencyCode: $currency->getCurrencyCode(),
            exchangeRate: $currency->getExchangeRate(),
        );
    }
}
