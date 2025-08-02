<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Auth;
use Illuminate\Http\Request;

class TransferController extends Controller {
    public static function checkAndUpdateTransfer (Transfer $transfer) {
        if ($transfer->status === Transfer::WORKING && now()->greaterThanOrEqualTo($transfer->expires_at)) {
            $transfer->status = Transfer::SUCCESSFUL;
            $transfer->save();
            $app_name = $transfer->app_name;
            $app_name = $app_name . '_level';
            $level = $transfer->app_level;
            Auth::user()[$app_name] = $level;
            Auth::user()->save();
        }
        return $transfer;
    }
}
