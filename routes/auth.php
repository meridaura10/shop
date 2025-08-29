<?php

use App\Http\Auth\Web\Controllers\ForgotPasswordController;
use App\Http\Auth\Web\Controllers\GitHubAuthController;
use App\Http\Auth\Web\Controllers\LoginController;
use App\Http\Auth\Web\Controllers\RegisterController;
use App\Http\Auth\Web\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (){
    Route::prefix('admin/')->name('admin.')->group(function (){
        Route::get('/login', [LoginController::class,'showAdminLoginForm'])->name('login');
        Route::get('/register', [RegisterController::class,'showAdminRegistrationForm'])->name('register');
    });

    Route::get('/login/github', [GitHubAuthController::class, 'redirectToGithub'])->name('login.github');
    Route::get('/github/login/callback', [GitHubAuthController::class, 'handleGitHubCallback'])->name('github.callback');

    Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
    Route::get('/register', [RegisterController::class,'showRegistrationForm'])->name('register');

    Route::post('/login', [LoginController::class,'login']);
    Route::post('/register', [RegisterController::class,'register']);

    Route::get('/password/forgot', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.forgot');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class,'reset'])->name('password.update');
});

Route::middleware('auth')->group(function (){
    Route::post('/logout', [LoginController::class,'logout'])->name('logout');
});
