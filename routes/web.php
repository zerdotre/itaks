<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

foreach (config('tenancy.central_domains') as $domain) {

    Route::domain($domain)->group(function () {

        Route::get('/', function () {
            return 'This is itaks.test, the id of the current tenant is ' . tenant('id');
        });

        Route::middleware('guest')->group(function () {
            Volt::route('register', 'pages.auth.register')
                ->name('register');
        
            Volt::route('login', 'pages.auth.login')
                ->name('login');
        
            Volt::route('forgot-password', 'pages.auth.forgot-password')
                ->name('password.request');
        
            Volt::route('reset-password/{token}', 'pages.auth.reset-password')
                ->name('password.reset');
        });
        
        Route::middleware('auth')->group(function () {
            Volt::route('verify-email', 'pages.auth.verify-email')
                ->name('verification.notice');
        
            Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');
        
            Volt::route('confirm-password', 'pages.auth.confirm-password')
                ->name('password.confirm');
    
            Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
        });
    
    });

}