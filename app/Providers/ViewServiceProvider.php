<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('client.layouts.inc.header', function (\Illuminate\View\View $view) {
            $view->with('pages', $this->getActivePages());
        });
    }

    protected function getActivePages(): Collection
    {
        return Cache::remember('pages', 3600, function () {
            return Page::query()->active()->get();
        });
    }
}
