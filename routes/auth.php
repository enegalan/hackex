<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Middleware\Anonymous;
use App\Http\Middleware\IsFullyVerified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/signin', [AuthController::class, 'signin']);

Route::post('/signup', [AuthController::class, 'signup']);

Route::middleware([IsFullyVerified::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware([Anonymous::class])->group(function () {
    Route::get('/forgot-password', [ViewController::class, 'forgotPassword']);
});
