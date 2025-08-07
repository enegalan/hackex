<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\WallpaperController;
use App\Http\Middleware\CheckDailyLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsFullyVerified;
use Illuminate\Http\Request;

Route::middleware([IsFullyVerified::class, CheckDailyLogin::class])->group(function () {
    Route::get('/', [ViewController::class, 'home'])->name('home');
    Route::get('/disconnect', [UserController::class, 'disconnect']);
    Route::post('/transfer', [UserController::class, 'transfer']);
    Route::post('/download', [UserController::class, 'download']);
    Route::post('/upload/{app_name}', [UserController::class, 'upload']);
    Route::post('/crack', [BankController::class, 'crack']);
    Route::post('/antivirus', [AppController::class, 'antivirus']);
    Route::post('/spam', [AppController::class, 'spam']);
    Route::post('/spyware', [AppController::class, 'spyware']);

    Route::get('/processes', [ViewController::class, 'processes']);
    Route::post('/hack', [UserController::class, 'hack']);
    Route::get('/hack', [UserController::class, 'hackRedirect']);
    Route::post('/process-remove', [UserController::class, 'processRemove']);
    Route::post('/multiprocess-remove', [UserController::class, 'multiProcessRemove']);
    Route::post('/process-shorten', [UserController::class, 'processShorten']);
    Route::post('/process-retry', [UserController::class, 'processRetry']);
    
    Route::get('/scan', [ViewController::class, 'scan']);
    Route::post('/scan-refresh', [ScanController::class, 'refreshScan']);
    Route::post('/ping', [ScanController::class, 'ping']);
    Route::post('/bypass',[ScanController::class, 'createBypass']);
    
    Route::get('/bank-account', [ViewController::class, 'bankAccount']);
    Route::post('/bank-account', [BankController::class, 'loginBankAccount'])->name('bank-account');
    Route::post('/deposit', [BankController::class, 'deposit']);
    
    Route::get('/store', [ViewController::class, 'store']);
    Route::post('/buy/{app_name}', [StoreController::class, 'buy']);
    
    Route::get('/messages', [ViewController::class, 'messages']);
    Route::get('/contacts', [MessageController::class, 'contacts']);
    Route::get('/friend/request', [MessageController::class, 'sendRequest']);
    Route::post('/friend/accept', [MessageController::class, 'acceptRequest']);
    Route::post('/friend/decline', [MessageController::class, 'declineRequest']);
    Route::post('/friend/remove', [MessageController::class, 'removeFriendship']);
    Route::post('/friend/compose', [MessageController::class, 'compose']);
    Route::post('/message', [MessageController::class, 'message']);
    Route::post('/message/delete', [MessageController::class, 'deleteMessage']);
    
    Route::get('/log', [ViewController::class, 'log']);
    Route::post('/save-log', [UserController::class, 'saveLog']);
    
    Route::get('/device', [ViewController::class, 'device']);
    Route::post('/ip-change', [UserController::class, 'changeIp']);
    Route::post('/select-wallpaper', [WallpaperController::class, 'select']);
    Route::get('/leaderboards', [ViewController::class, 'leaderboards']);
});

require __DIR__ . '/auth.php';

Route::fallback(function () {
    return redirect('/')->with('error', 'Page not found.');
});