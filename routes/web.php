<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsFullyVerified;

Route::get('/forgot-password', function () {
    return view('forgot-password');
});

Route::middleware([IsFullyVerified::class])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    
    Route::get('/processes', function () {
        return view('processes');
    });
    
    Route::get('/scan', function () {
        return view('scan');
    });
    
    Route::get('/bank-account', function () {
        return view('bank-login');
    });
    Route::post('/bank-account', function () {
        return view('bank-account');
    });
    
    Route::get('/store', function () {
        return view('store');
    });
    
    Route::get('/messages', function () {
        return view('messages');
    });
    
    Route::get('/log', function () {
        return view('log');
    });
    
    Route::get('/device', function () {
        return view('my-device');
    });
});
