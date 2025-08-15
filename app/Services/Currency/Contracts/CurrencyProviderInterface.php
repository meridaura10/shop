<?php

namespace App\Services\Currency\Contracts;

interface CurrencyProviderInterface
{
    public function wanted(): array;
}
