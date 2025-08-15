<?php

use App\Services\Currency\Contracts\CurrencyInterface;

if (!function_exists('currency')) {
    function currency(): CurrencyInterface
    {
        return app(CurrencyInterface::class);
    }
}
