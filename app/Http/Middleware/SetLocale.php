<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next) {
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
            if (\Arr::get(config('app.locales'), $locale, false)) {
                App::setLocale($locale);
            }
        }
        return $next($request);
    }

}
