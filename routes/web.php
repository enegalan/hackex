<?php

use Illuminate\Support\Facades\Route;

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