<?php

namespace App\Http\Middleware;

use App\Models\DailyLogin;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDailyLogin {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        if (auth()->check()) {
            $user = auth()->user();
            $today = Carbon::today();
            $alreadyLogged = DailyLogin::where('user_id', $user->id)
                ->whereDate('login_date', $today)
                ->exists();
            if (!$alreadyLogged) {
                $user->oc += config('core.earnings.daily_login');
                $user->save();
                DailyLogin::create([
                    'user_id' => $user->id,
                    'login_date' => $today,
                ]);
            }
        }
        return $next($request);
    }
}
