<?php


use App\Http\Admin\Controllers\SettingController;
use App\Http\Client\web\Controllers\ArticleController;
use App\Http\Client\web\Controllers\CartController;
use App\Http\Client\web\Controllers\CatalogController;
use App\Http\Client\web\Controllers\FavoriteController;
use App\Http\client\web\Controllers\HomeController;
use App\Http\Client\web\Controllers\MyController;
use App\Http\Client\web\Controllers\OrderController;
use App\Http\Client\web\Controllers\PageController;
use App\Http\Client\web\Controllers\PaymentController;
use App\Http\Client\web\Controllers\ProductController;
use App\Http\Client\web\Controllers\ReviewController;
use App\Http\Client\web\Controllers\SuggestController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::get('/error', function () {
    abort(403);
});

Route::get('/', HomeController::class)->name('home');

Route::prefix('/favorites')->name('favorites.')->controller(FavoriteController::class)->group(function () {
   Route::get('/', 'index')->name('index');
});

Route::prefix('orders')->name('orders.')->controller(OrderController::class)->group(function () {
    Route::get('/checkout', 'checkout')->name('checkout');
});

Route::prefix('/catalog')->name('catalog.')->controller(CatalogController::class)->group(function () {
   Route::get('/', 'index')->name('index');
    Route::get('/{term:slug}', 'show')->name('show');
    Route::get('/{category:slug}/{product:slug}', [ProductController::class, 'show'])->name('products.show');
});

Route::prefix('/cart')->name('cart.')->controller(CartController::class)->group(function () {
   Route::get('/', 'index')->name('index');
   Route::post('/update/{purchase}', 'update')->name('update');
   Route::post('/add/{product}', 'add')->name('add');
   Route::delete('/remove/{purchase}', 'remove')->name('remove');
    Route::post('/clear/', 'clear')->name('clear');

});

Route::prefix('/articles')->name('articles.')->controller(ArticleController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{article:slug}', 'show')->name('show');
});

Route::prefix('/my')->middleware('auth')->name('my.')->controller(MyController::class)->group(function () {
    Route::get('/profile', 'profile')->name('profile');
    Route::post('/profile', 'updateProfile')->name('update-profile');
    Route::get('/orders/{order}', 'orderShow')->name('orders.show');

    Route::prefix('/favorites')->name('favorites.')->controller(FavoriteController::class)->group(function () {
        Route::post('/article/{article}', 'favoriteToggleArticle')->name('toggle.favorite');
        Route::post('/products/{product}', 'favoriteToggleProduct')->name('toggle.product');

    });
});

Route::prefix('/reviews')->controller(ReviewController::class)->name('reviews.')->group(function () {
    Route::post('/store', 'store')->name('store');
    Route::put('/{review}', 'update')->name('update');
    Route::delete('/{review}', 'destroy')->name('destroy');
});

Route::prefix('checkout')->middleware('checkout')->name('checkout.')->controller(OrderController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'checkout')->name('store');
});

Route::prefix('suggest')->controller(SuggestController::class)->name('suggest.')->group(function () {
   Route::get('/settlements/{type}', 'settlements')->name('settlements');
});

Route::any('/payment/response/{payment}', [PaymentController::class, 'response'])->name('payment.response');

Route::get('/sitemap.xml', [SettingController::class, 'sitemap'])->name('sitemap');
Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');
