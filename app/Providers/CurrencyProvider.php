<?php

namespace App\Providers;

use App\Services\Currency\Contracts\CurrencyInterface;
use App\Services\Currency\CurrencyService;
use Illuminate\Support\ServiceProvider;

class CurrencyProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CurrencyInterface::class, CurrencyService::class);
        $this->app->alias(CurrencyInterface::class, 'currency');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
