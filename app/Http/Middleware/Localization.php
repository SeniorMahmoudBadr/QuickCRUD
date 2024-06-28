<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {

        if ( \Session::has('locale')) {
            \App::setLocale(\Session::get('locale'));

            // You also can set the Carbon locale
            Carbon::setLocale(\Session::get('locale'));
        }

        return $next($request);
    }
}
