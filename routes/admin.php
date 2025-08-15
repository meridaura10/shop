<?php

use App\Http\Admin\Controllers\ArticleController;
use App\Http\Admin\Controllers\AttributeController;
use App\Http\Admin\Controllers\CharacteristicController;
use App\Http\Admin\Controllers\DistributionController;
use App\Http\Admin\Controllers\HomeController;
use App\Http\Admin\Controllers\LeadController;
use App\Http\Admin\Controllers\OrderController;
use App\Http\Admin\Controllers\PageController;
use App\Http\Admin\Controllers\ProductController;
use App\Http\Admin\Controllers\PurchaseController;
use App\Http\Admin\Controllers\RoleController;
use App\Http\Admin\Controllers\TermController;
use App\Http\Admin\Controllers\UserController;
use App\Http\Auth\Web\Controllers\ForgotPasswordController;
use App\Http\Auth\Web\Controllers\LoginController;
use App\Http\Auth\Web\Controllers\RegisterController;
use App\Http\Auth\Web\Controllers\ResetPasswordController;
use App\Http\Controllers\SuggestController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (){
    Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class,'login']);

    Route::get('/register', [RegisterController::class,'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class,'register']);

    Route::get('/password/forgot', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.forgot');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class,'reset'])->name('password.update');
});

Route::middleware('auth')->group(function (){
   Route::post('/logout', [LoginController::class,'logout'])->name('logout');

   Route::prefix('/admin/profile')->middleware('admin')->controller(\App\Http\Admin\Controllers\ProfileController::class)->name('admin.profile.')->group(function (){
       Route::get('/edit/', 'edit')->name('edit');
       Route::patch('/{user}/update', 'update')->name('update');
   });
});

Route::prefix('admin/')->name('admin.')->middleware('admin')->group(function (){
    Route::get('/', HomeController::class)->name('home');
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
    Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');

    Route::resource('attributes', AttributeController::class)->except(['show']);
    Route::resource('articles', ArticleController::class)->except(['show']);
    Route::resource('pages', PageController::class)->except(['show']);
    Route::resource('leads', LeadController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::resource('orders', OrderController::class)->except(['show']);
    Route::resource('distributions', DistributionController::class)->except(['show','create', 'edit']);
    Route::post('/distributions/{distribution}/put', [DistributionController::class, 'put'])->name('distributions.put');
    Route::resource('purchases', PurchaseController::class)->except(['show','index','store']);
    Route::post('/{order}/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::post('purchases/{purchase}/put', [PurchaseController::class, 'put'])->name('purchases.put');
    Route::post('/terms/order', [TermController::class, 'order'])->name('terms.order');

    Route::prefix('/terms')->controller(TermController::class)->name('terms.')->group(function (){
        Route::get('/{vocabularySlug}', 'index')->name('index');
        Route::get('/edit/{term}', 'edit')->name('edit');
        Route::patch('/{term}', 'update')->name('update');
        Route::delete('/{term}', 'destroy')->name('destroy');
        Route::post('/{vocabularySlug}', 'store')->name('store');
        Route::get('/{vocabularySlug}/create', 'create')->name('create');
    });

    Route::prefix('/characteristic/')->name('characteristic.')->controller(CharacteristicController::class)->group(function (){
        Route::post('/{attribute}/store','store')->name('store');
        Route::get('/{characteristic}/edit','edit')->name('edit');
        Route::patch('/{characteristic}/update', 'update')->name('update');
        Route::delete('/{characteristic}/delete',  'destroy')->name('destroy');
    });



    Route::prefix('/suggest/')->controller(SuggestController::class)->name('suggest.')->group(function (){
        Route::get('/terms/{vocabulary}', 'terms')->name('terms');
        Route::get('/roles', 'roles')->name('roles');
        Route::get('/permissions', 'permissions')->name('permissions');
        Route::get('/products', 'products')->name('products');
        Route::get('/users', 'users')->name('users');
    });
});

