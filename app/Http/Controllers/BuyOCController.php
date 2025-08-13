<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class BuyOCController extends Controller {
    public static function purchase($value) {
        $user = Auth::user();
        // Validate enough OC
        if ($user->oc < $value) return back()->with('error', __('errors.not_enough_oc'));
        // Discount OC
        $user->oc -= $value;
        return true;
    }
    public static function generateFinishValueOC($expires_at) {
        $expires_at = $expires_at instanceof \Carbon\Carbon
        ? $expires_at
        : \Carbon\Carbon::parse($expires_at);
        $now = now();
        if ($expires_at->lessThanOrEqualTo($now)) return 0;
        $secondsRemaining = $now->diffInSeconds($expires_at);
        $costPerSecond = config('core.costs.oc.finish_process_per_second');
        return round($secondsRemaining * $costPerSecond, 0);
    }
}
