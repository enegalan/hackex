<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordCodeController;
use App\Http\Controllers\ViewController;
use App\Http\Middleware\Anonymous;
use App\Http\Middleware\IsFullyVerified;
use Illuminate\Support\Facades\Route;


Route::middleware([IsFullyVerified::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware([Anonymous::class])->group(function () {
    Route::post('/signin', [AuthController::class, 'signin']);
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::get('/forgot-password', [ViewController::class, 'forgotPassword']);
    Route::post('/forgot-password-code', [PasswordCodeController::class, 'sendCode'])->name('password.code.send');

    Route::post('/verify-password-code', [PasswordCodeController::class, 'verifyCode'])->name('password.code.verify');

    Route::post('/reset-password-code', [PasswordCodeController::class, 'resetPassword'])->name('password.code.reset');
});
