<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravolt\Avatar\LumenServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }

    public function setMorphMap(): void
    {
        Relation::morphMap([
            'user' => \App\Models\User::class,
            'attribute' => \App\Models\Attribute::class,
            'order' => \App\Models\Order::class,
            'product' => \App\Models\Product::class,
            'page' => \App\Models\Page::class,
            'lead' => \App\Models\Lead::class,
        ]);

        $this->app->register(LumenServiceProvider::class);
    }
}
