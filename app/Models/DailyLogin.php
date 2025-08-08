<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DailyLogin extends Model {
    protected $fillable = [
        'user_id',
        'login_date',
    ];
    const WEEKDAYS = [
        1 => "M",   // Monday
        2 => "Tu",  // Tuesday
        3 => "W",   // Wednesday
        4 => "Th",  // Thursday
        5 => "F",   // Friday
        6 => "Sa",  // Saturday
        7 => "Su",  // Sunday
    ];
    public function User() {
        return $this->belongsTo(User::class);
    }
    public static function getPlayerDailyStreak(User $user) {
        $logins = self::where('user_id', $user->id)
        ->whereBetween('login_date', [now()->startOfWeek(), now()->endOfWeek()])
        ->pluck('login_date')
        ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
        ->unique();
        return $logins->count();
    }
    public static function getPlayerDailyLoginEarned(User $user) {
        $loginDays = self::where('user_id', $user->id)
        ->whereBetween('login_date', [now()->startOfWeek(), now()->endOfWeek()])
        ->pluck('login_date')
        ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
        ->unique()
        ->count();
        return $loginDays * config('core.earnings.oc.daily_login');
    }
    public static function getPlayerDailyLoginWeekDays(User $user) {
        $logins = self::where('user_id', $user->id)
        ->whereBetween('login_date', [now()->startOfWeek(), now()->endOfWeek()])
        ->get()
        ->mapWithKeys(function ($login) {
            $date = Carbon::parse($login->login_date);
            return [$date->dayOfWeekIso => true];
        });
        $weekdays = [];
        foreach (self::WEEKDAYS as $dayNum => $label) {
            $weekdays[] = [
                'weekday' => $label,
                'logged' => $logins->has($dayNum),
            ];
        }
        return $weekdays;
    }
}
