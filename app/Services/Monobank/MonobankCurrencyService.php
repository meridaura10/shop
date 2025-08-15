<?php

namespace App\Services\Monobank;

use App\Services\Currency\Bags\CurrencyBag;
use App\Services\Currency\Contracts\CurrencyProviderInterface;
use Illuminate\Support\Facades\Cache;

class MonobankCurrencyService implements CurrencyProviderInterface
{
    protected MonobankApiService $api;

    public function __construct()
    {
        $this->api = new MonobankApiService();
    }

    public function wanted(): array
    {
        return Cache::remember('monobank_wanted_rates', 60 * 60, function () {
            $currencies = $this->all();

            $wantedCodes = collect(config('currency.wanted'))->pluck('codeA')->all();
            $baseCurrency = config('currency.base_currency');

            $wanted = array_filter($currencies, function (CurrencyBag $currency) use ($wantedCodes, $baseCurrency) {
                return in_array($currency->codeA, $wantedCodes, true)
                    && $currency->codeB === $baseCurrency['codeA'];
            });

            $wanted[] = new CurrencyBag(
                $baseCurrency['name'],
                $baseCurrency['codeA'],
                $baseCurrency['codeA'],
            );

            return $wanted;
        });
    }

    public function all(): array
    {
       $currencies = $this->api->fetch('currency');

        return array_map(function (array $currency) {
            $wanted = collect(config('currency.wanted'))
                ->firstWhere('codeA', $currency['currencyCodeA']);

            return new CurrencyBag(
                $wanted['name'] ?? null,
                $currency['currencyCodeA'],
                $currency['currencyCodeB'],
                    $currency['rateBuy'] ?? null,
                    $currency['rateSell'] ?? null,
                    $currency['rateCross'] ?? null
            );
        }, $currencies);
    }
}
