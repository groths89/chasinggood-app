<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::middleware('guest')->group(function () {
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
});

Route::middleware(['auth', 'hasrole:super_admin'])->group(function () {});

Route::middleware(['auth', 'hasrole:administrator'])->group(function () {
    // Routes accessible only to administrators
});

Route::middleware(['auth', 'hasrole:volunteer'])->group(function () {
    // Routes accessible only to volunteers
});
