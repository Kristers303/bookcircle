<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class SetLocaleFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supported = ['en', 'lv'];
        $locale = $request->cookie('language');

        /// Ja cookie nav iestatīta valoda, tad mēģinām iegūt to no Accept-Language galvenes
        if (!$locale) {
            $locale = $request->getPreferredLanguage($supported);
            if (!in_array($locale, $supported)) {
                $locale = config('app.locale'); // fallback
            }
        }

        App::setLocale($locale);

        return $next($request);
    }
}
