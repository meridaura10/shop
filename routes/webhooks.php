<?php

use App\Http\Auth\Web\Controllers\GitHubAuthController;
use App\Http\Client\web\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
