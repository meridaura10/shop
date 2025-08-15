<?php


use App\Http\Client\web\controllers\ArticleController;
use App\Http\Client\web\controllers\CartController;
use App\Http\Client\web\controllers\CatalogController;
use App\Http\Client\web\controllers\CategoryController;
use App\Http\Client\web\controllers\FavoriteController;
use App\Http\client\web\controllers\HomeController;
use App\Http\Client\web\controllers\MyController;
use App\Http\Client\web\controllers\OrderController;
use App\Http\Client\web\controllers\PageController;
use App\Http\Client\web\controllers\ProductController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';

Route::get('/', HomeController::class)->name('home');

Route::prefix('/products')->name('products.')->controller(ProductController::class)->group(function () {
   Route::get('/', 'index')->name('index');
   Route::get('/search', 'search')->name('search');
    Route::get('/{product}', 'show')->name('show');
});

Route::prefix('/favorites')->name('favorites.')->controller(FavoriteController::class)->group(function () {
   Route::get('/', 'index')->name('index');
});

Route::prefix('orders')->name('orders.')->controller(OrderController::class)->group(function () {
    Route::get('/checkout', 'checkout')->name('checkout');
});

Route::prefix('/catalog')->name('catalog.')->controller(CatalogController::class)->group(function () {
   Route::get('/', 'index')->name('index');
});

Route::prefix('/categories')->name('categories.')->controller(CategoryController::class)->group(function () {
    Route::get('/{category}', 'show')->name('show');
});

Route::prefix('/cart')->name('cart.')->controller(CartController::class)->group(function () {
   Route::get('/', 'index')->name('index');
});

Route::prefix('/articles')->name('articles.')->controller(ArticleController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{article}', 'show')->name('show');
});

Route::prefix('/my')->name('my.')->controller(MyController::class)->group(function () {
    Route::get('/profile', 'profile')->name('profile');
});

Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');
