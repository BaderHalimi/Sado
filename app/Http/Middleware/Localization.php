<?php

namespace App\Http\Middleware;

use App\CPU\Helpers;
use Closure;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }else{
            App::setLocale(Helpers::default_lang());
        }
        return $next($request);
    }
}
