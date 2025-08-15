<?php

namespace App\Services\Currency;

use App\Services\Currency\Bags\CurrencyBag;
use App\Services\Currency\Contracts\CurrencyInterface;
use App\Services\Currency\Contracts\CurrencyProviderInterface;

class CurrencyService implements CurrencyInterface
{
    public function __construct(
        protected CurrencyProviderInterface $currencyProvider,
    ) {

    }

    public function convertWanted(float $price): array
    {
        $wanted = $this->currencyProvider->wanted();

        return array_map(function (CurrencyBag $currency) use ($price) {
            return $this->convert($price, $currency);
        }, $wanted);
    }

    public function convert(float $price, CurrencyBag $currency): array
    {
        return [
            'base' => $price,
            'convert' => $currency->convert($price),
            'currency' => $currency,
        ];
    }

    public function getCurrencyProvider(): CurrencyProviderInterface
    {
        return $this->currencyProvider;
    }
}
