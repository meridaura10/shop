<?php

use App\Services\Currency\Contracts\CurrencyInterface;

if (!function_exists('currency')) {
    function currency(): CurrencyInterface
    {
        return app(CurrencyInterface::class);
    }
}

if (!function_exists('favorite')) {
    function favorite(): \App\Services\Favorite\FavoriteService
    {
        return app('favorite');
    }
}

if (!function_exists('cart')) {
    function cart(): \App\Services\Cart\CartService
    {
        return app('cart');
    }
}
