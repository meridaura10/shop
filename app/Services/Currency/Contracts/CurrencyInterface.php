<?php

namespace App\Services\Currency\Contracts;

use App\Services\Currency\Bags\CurrencyBag;

interface CurrencyInterface
{
    public function convert(float $price, CurrencyBag $currency): array;

    public function convertWanted(float $price): array;
}
