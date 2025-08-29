<?php

use App\Http\Auth\Api\ForgotPasswordController;
use App\Http\Auth\Api\LoginController;
use App\Http\Auth\Api\RegisterController;
use App\Http\Auth\Api\ResetPasswordController;
use App\Http\Client\api\Controllers\CartController;
use App\Http\Client\api\Controllers\CategoryController;
use App\Http\Client\api\Controllers\LeadController;
use App\Http\Client\api\Controllers\MyController;
use App\Http\Client\api\Controllers\PageController;
use App\Http\Client\api\Controllers\ProductController;
use App\Http\Client\api\Controllers\ProductReviewCollection;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.forgot');
});

Route::get('/page/{page:slug}', [PageController::class, 'show'])->name('page.show');

Route::prefix('/categories')->name('categories.')->controller(CategoryController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{term:slug}','show')->name('show');
});

Route::prefix('/products')->name('products.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/search', 'search')->name('search');
    Route::get('/{product:slug}', 'show')->name('show');

    Route::prefix('/{product:id}')->group(function () {
        Route::get('/reviews', [ProductReviewCollection::class, 'index'])->name('index');
        Route::post('/reviews', [ProductReviewCollection::class, 'store'])->name('store');
        Route::post('/favorites', 'favoriteToggle')->middleware('auth:sanctum')->name('favorite.toggle');
    });
});

Route::prefix('/cart')->name('cart.')->controller(CartController::class)->group(function () {
    Route::get('/', 'show')->name('show');
    Route::post('/{product:id}/add', 'add')->name('add');
    Route::post('/{purchase:id}/remove', 'remove')->name('remove');

    Route::post('/shopping', 'shopping')->name('shopping');
    Route::post('/checkout', 'checkout')->name('checkout');
});

Route::prefix('/my')->name('my.')->middleware('auth:sanctum')->controller(MyController::class)->group(function () {
    Route::get('/profile', 'profile')->name('profile');
    Route::post('/profile', 'updateProfile')->name('profile.store');

    Route::get('/orders', 'orders')->name('orders');
    Route::get('/favorites', 'favorites')->name('favorites');
});

Route::post('subscription', [LeadController::class, 'store'])->name('subscription.store');

