<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class BuyOCController extends Controller {
    const CRYPTOCOIN = 0;
    const OC = 1;
    const CURRENCIES = [
        0 => 'bitcoin',
        1 => 'oc',
    ];
    public static function purchase($value, $validation_return_back = true) {
        $user = Auth::user();
        // Validate enough OC
        if ($user->oc < $value) {
            return back()->with('error', 'Not enough OC');
        }
        // Discount OC
        $user->oc -= $value;
        return $user->save();
    }

    public static function generateFinishValueOC($expires_at) {
        $expires_at = $expires_at instanceof \Carbon\Carbon
        ? $expires_at
        : \Carbon\Carbon::parse($expires_at);
        $now = now();
        if ($expires_at->lessThanOrEqualTo($now)) {
            return 0;
        }
        $secondsRemaining = $now->diffInSeconds($expires_at);
        $costPerSecond = 0.0111152555;
        return round($secondsRemaining * $costPerSecond, 0);
    }
}
