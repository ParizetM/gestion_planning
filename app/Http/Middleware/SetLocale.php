<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function handle($request, Closure $next): mixed
    {
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            if (is_string($locale) && in_array($locale, ['en', 'fr'])) {
                App::setLocale($locale);
            }
        }

        return $next($request);
    }
}
