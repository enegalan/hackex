<?php

namespace App\Http\Middleware;

use App;
use App\Enums\Locales;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromBrowser {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $locale = $request->getPreferredLanguage(Locales::$availableLocales);
        if ($locale) {
            App::setLocale($locale);
        }
        return $next($request);
    }
}
