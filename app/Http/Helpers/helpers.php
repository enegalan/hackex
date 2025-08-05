<?php

use App\Models\Network;
use App\Models\Transfer;

require_once __DIR__ . '/str_camelcase.php';
require_once __DIR__ . '/numbers.php';

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
function getRandomMatchedUsers(User $baseUser, int $range = 20) {
    $cacheHtmlKey = 'html_matched_users_' . $baseUser->id;
    $cacheKey = 'matched_users_' . $baseUser->id;
    if (Cache::get($cacheKey)) {
        return Cache::get($cacheKey);
    }
    $excludedVictimIds = Bypass::where('user_id', $baseUser->id)
        ->where('available', false)
        ->pluck('victim_id');
    $minLevel = max(1, $baseUser->level - $range);
    $maxLevel = $baseUser->level + $range;
    // Find users within level range
    $results = User::where('id', '!=', $baseUser->id)
        ->whereNotIn('id', $excludedVictimIds)
        ->whereBetween('level', [$minLevel, $maxLevel])
        ->inRandomOrder()
        ->limit(5)
        ->get();
    // If not found, ignore level filter
    if ($results->isEmpty()) {
        $results = User::where('id', '!=', $baseUser->id)
            ->whereNotIn('id', $excludedVictimIds)
            ->inRandomOrder()
            ->limit(5)
            ->get();
    }
    Cache::set($cacheKey, $results);
    Cache::set($cacheHtmlKey, generateScanListHtml($results));
    return $results;
}

function generateScanListHtml($users) {
    $html = '<ul>';
    foreach ($users as $user) {
        $html .= '
            <li onclick="openBypassWindow(\'' . $user->ip . '\', \'' . $user->firewall_level . '\', \'' . Auth::user()->bypasser_level . '\')" class="ip-user">
                <span class="ip-value">' . $user->ip . '</span>
                <div class="firewall-label">
                    <span>Firewall level</span>
                    <span class="firewall-value">' . $user->firewall_level . '</span>
                </div>
            </li>
        ';
    }
    $html .= '</ul>';
    return $html;
}

use Carbon\Carbon;
function calculateBypassExpiration(int $firewallLevel, int $bypasserLevel) {
    $levelDiff = $firewallLevel - $bypasserLevel;
    // Minimum waiting time
    $baseMinutes = 2;
    // Exponential penalty if bypasser is weaker than firewall
    if ($levelDiff > 0) {
        $extraMinutes = pow($levelDiff, 2);
    } else {
        $extraMinutes = max(0, $levelDiff); // could be 0 or negative (if bypasser is better)
    }
    $totalMinutes = $baseMinutes + $extraMinutes;
    return now()->addMinutes($totalMinutes);
}
function calculateCrackExpiration(int $passwordEncryptorLevel, int $passwordCracker) {
    $levelDiff = $passwordEncryptorLevel - $passwordCracker;
    // Minimum waiting time
    $baseMinutes = 4;
    // Exponential penalty if password cracker is weaker than password encryptor
    if ($levelDiff > 0) {
        $extraMinutes = pow($levelDiff, 2);
    } else {
        $extraMinutes = max(0, $levelDiff); // could be 0 or negative (if password cracker is better)
    }
    $totalMinutes = $baseMinutes + $extraMinutes;
    return now()->addMinutes($totalMinutes);
}
function calculateDownloadExpiration(User $user, string $appName) {
    $network = $user->network;
    if (!$network || empty($network->download)) {
        return now()->addMinutes(15); // fallback
    }
    $kbps = parseNetworkSpeedToKbps($network->download);
    $levelColumn = "{$appName}_level";
    $appLevel = $user->$levelColumn ?? 1;
    // Each level adds +MB
    $baseSizeInKb = 50; // 50KB
    $totalSizeInKb = $baseSizeInKb * $appLevel;
    $minutes = ceil($totalSizeInKb / max($kbps, 1));
    return now()->addMinutes($minutes);
}
function calculateUploadExpiration(User $user, string $appName) {
    $network = $user->network;
    if (!$network || empty($network->upload)) {
        return now()->addMinutes(15); // fallback
    }
    $kbps = parseNetworkSpeedToKbps($network->upload);
    $levelColumn = "{$appName}_level";
    $appLevel = $user->$levelColumn ?? 1;
    // Each level adds +MB
    $baseSizeInKb = 10; // 10KB
    $totalSizeInKb = $baseSizeInKb * $appLevel;
    $minutes = ceil($totalSizeInKb / max($kbps, 1));
    return now()->addMinutes($minutes);
}
function parseNetworkSpeedToKbps(string $download): float {
    [$value, $unit] = explode(' ', trim($download));
    $value = floatval($value);
    $unit = strtolower($unit);
    return match ($unit) {
        'bps' => $value / 1000,
        'kbps' => $value,
        'mbps' => $value * 1000,
        'gbps' => $value * 1000 * 1000,
        default => $value,
    };
}

function calculateIncomePerHour(Transfer $transfer): float {
    $BASE = 20; // TODO: Move this to a config
    $level = $transfer->app_level ?? 1;
    return $BASE * $level;
}

function getTotalEarningsForTransfer(Transfer $transfer): float {
    if (!$transfer->expires_at) return 0;
    $now = Carbon::now();
    $start = new Carbon($transfer->expires_at);
    if ($start > $now) return 0;
    $hours = max(1, $start->diffInHours($now));
    $incomePerHour = calculateIncomePerHour($transfer);
    return $incomePerHour * $hours;
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

function truncateWithDots($text, $limit = 100) {
    $exceeds = strlen($text) > $limit;
    $truncated = $exceeds
        ? mb_substr($text, 0, $limit)
        : $text;
    $return = str_replace("\n", "", $truncated);
    $return = str_replace("\n", '<br>', $truncated);
    return str_replace('', '', ($return)) . '...';
}