<?php

namespace App\Providers;

use App\Services\Currency\Contracts\CurrencyProviderInterface;
use App\Services\Monobank\MonobankCurrencyService;
use Illuminate\Support\ServiceProvider;

class MonobankProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CurrencyProviderInterface::class, MonobankCurrencyService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
