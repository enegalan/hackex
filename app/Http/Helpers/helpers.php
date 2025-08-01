<?php

require_once __DIR__ . '/str_camelcase.php';

function getLevelBackgroundName($level) {
    $stages = [
        1 => 'initial',   // Round blue
        5 => 'basic',   // Round blue with borders
        10 => 'medium',    // Round orange
        15 => 'advanced',    // Round with black and green background
        20 => 'expert',   // Upward green arrow
        30 => 'anonymous',  // Anonymous
    ];
    $bg_name = null;
    foreach ($stages as $minLevel => $name) {
        if ($level >= $minLevel) $bg_name = $name;
        else break;
    }
    return $bg_name;
}

use \App\Models\User;
use \App\Models\Bypass;
function getRandomMatchedUsers(User $baseUser, int $range = 3) {
    $excludedVictimIds = Bypass::where('user_id', $baseUser->id)
        ->pluck('victim_id');
    return User::where('id', '!=', $baseUser->id)
        ->whereNotIn('id', $excludedVictimIds)
        ->whereBetween('level', [
            $baseUser->level - $range,
            $baseUser->level + $range
        ])
        ->inRandomOrder()
        ->limit(5)
        ->get();
}

use Carbon\Carbon;
function calculateBypassExpiration(int $firewallLevel, int $bypasserLevel) {
    $levelDiff = $firewallLevel - $bypasserLevel;
    // Minimum waiting time
    $baseMinutes = 2;
    // Exponential penalty if bypasser is weaker than firewall
    if ($levelDiff > 0) {
        $extraMinutes = pow($levelDiff, 2); // 1=>1, 2=>4, 3=>9, etc.
    } else {
        $extraMinutes = max(0, $levelDiff); // could be 0 or negative (if bypasser is better)
    }
    $totalMinutes = $baseMinutes + $extraMinutes;
    return Carbon::now('UTC')->addMinutes($totalMinutes);
}

/**
 * Returns spent time from one date in format: "Xd Xh Xm" or "Xd Xh Xm Xs".
 *
 * @param \Carbon\Carbon|string $future Future date
 * @param bool $withSeconds Show seconds
 * @return string
 */
function diffInHumanTime($future, $withSeconds = true) {
    if (is_string($future)) $future = Carbon::parse($future);
    $now = Carbon::now();
    $diffInSeconds = abs($future->diffInSeconds($now, false));
    $days = floor($diffInSeconds / 86400);
    $hours = floor(($diffInSeconds % 86400) / 3600);
    $minutes = floor(($diffInSeconds % 3600) / 60);
    $seconds = $diffInSeconds % 60;
    $return = "{$days}d {$hours}h {$minutes}m";
    if ($withSeconds) $return.= " {$seconds}s";
    return $return;
}
