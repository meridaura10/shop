<?php

namespace App\Providers;

use App\Services\Cart\CartService;
use App\Services\Currency\Contracts\CurrencyInterface;
use App\Services\Currency\CurrencyService;
use App\Services\Favorite\FavoriteService;
use App\Services\Payment\LiqPay\LiqPayPaymentService;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->setMorphMap();
        $this->bindingsServices();
        $this->app->bind(LiqPayPaymentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->ngrokUrl();

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }

    public function ngrokUrl(): void
    {
        if ($url = env('NGROK_URL')) {
            URL::forceScheme(env('NGROK_SCHEME') ?: 'https');
            URL::forceRootUrl($url);
        }
    }

    public function setMorphMap(): void
    {
        Relation::morphMap([
            'user' => \App\Models\User::class,
            'attribute' => \App\Models\Attribute::class,
            'order' => \App\Models\Order::class,
            'product' => \App\Models\Product::class,
            'article' => \App\Models\Article::class,
            'page' => \App\Models\Page::class,
            'lead' => \App\Models\Lead::class,
        ]);
    }

    protected function bindingsServices(): void
    {
        $this->app->singleton(CartService::class);
        $this->app->alias(CartService::class, 'cart');

        $this->app->singleton( FavoriteService::class);
        $this->app->alias(FavoriteService::class, 'favorite');

        $this->app->singleton(CurrencyInterface::class, CurrencyService::class);
        $this->app->alias(CurrencyInterface::class, 'currency');
    }
}
