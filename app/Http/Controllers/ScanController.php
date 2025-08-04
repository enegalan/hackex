<?php

namespace App\Http\Controllers;

use App\Models\Bypass;
use App\Models\User;
use Auth;
use Cache;
use Illuminate\Http\Request;

class ScanController extends Controller {
    function ping(Request $request) {
        $ip = $request->input('ip-search');
        if (!$ip) {
            return back()->with('error', 'Please enter an IP address.');
        }
        $user = User::where('ip', $ip)->first();
        if (!$user) {
            return back()->with('error', 'No user found with that IP address.');
        }
        return back()->with('ping_result', $user);
    }
    function createBypass(Request $request) {
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
            'victim_id' => $victim->id,
            'expires_at' => calculateBypassExpiration($firewallLevel, $bypasserLevel),
        ]);
        LogController::doLog(LogController::BYPASS, Auth::user(), ['ip' => $victim->ip]);
        return back()->with('message', 'Bypass has started.');
    }
    function refreshScan() {
        $user_id = Auth::id();
        Cache::forget('html_matched_users_' . $user_id);
        Cache::forget('matched_users_' . $user_id);
        $users = getRandomMatchedUsers(Auth::user());
        $html = generateScanListHtml($users);
        return response()->json($html);
    }
}
