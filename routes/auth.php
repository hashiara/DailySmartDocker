<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function() {
        return view('auth.login');
    })->name('login.page');
    
    Route::get('register', function() {
        return view('auth.register');
    })->name('register.page');

    Route::post('register', [RegisteredUserController::class, 'store'])
                ->name('register.store');

    Route::post('login', [RegisteredUserController::class, 'login'])
                ->name('login.auth');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::delete('/addDataDelete', [LoginedController::class, 'delete'])
                ->name('account.delete');
});
