<?php

use App\Models\Bypass;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsFullyVerified;
use Illuminate\Http\Request;

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
    Route::post('/ping', function (Request $request) {
        $ip = $request->input('ip-search');
        if (!$ip) {
            return back()->with('error', 'Please enter an IP address.');
        }
        $user = User::where('ip', $ip)->first();
        if (!$user) {
            return back()->with('error', 'No user found with that IP address.');
        }
        return back()->with('ping_result', $user);
    });
    Route::post('/bypass',function (Request $request) {
        $request->validate([
            'firewall_level' => 'required|integer|min:1',
            'bypasser_level' => 'required|integer|min:1',
        ]);
        $firewallLevel = $request->input('firewall_level');
        $bypasserLevel = $request->input('bypasser_level');
        $ip = $request->input('ip');
        $victim = User::where('ip', $ip)->first();
        Bypass::create([
            'user_id' => Auth::id(),
            'victim_id' => $victim['id'],
            'expires_at' => calculateBypassExpiration($firewallLevel, $bypasserLevel),
        ]);
        return back()->with('message', 'Bypass iniciado correctamente.');
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

require __DIR__ . '/auth.php';
