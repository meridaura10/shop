<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Product;
use App\Models\Term;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteBindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
//        Route::bind('page:slug', function (string $slug) {
//            return $this->getPage($slug);
//        });
//
//        Route::bind('product:slug', function (string $slug) {
//            return $this->getProduct($slug);
//        });
//
//        Route::bind('category:slug', function (string $slug) {
//            return $this->getCategory($slug);
//        });
    }

    public function getPage(string $slug): Page
    {
        return Page::active()->where('slug', $slug)->firstOrFail();
    }

    public function getProduct(string $slug): Product
    {
        return Product::active()->where('slug', $slug)->firstOrFail();
    }

    public function getCategory(string $slug): Term
    {
        return Term::active()->where('slug', $slug)->firstOrFail();
    }
}
