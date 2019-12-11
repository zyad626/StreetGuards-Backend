<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class LanguageSetter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Session::has('locale'))
        {
           Session::put('locale', \Config::get('app.locale'));
        }

        app()->setLocale(Session::get('locale'));

        return $next($request);
    }
}
