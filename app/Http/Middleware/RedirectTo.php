<?php

namespace App\Http\Middleware;

use Closure;

class RedirectTo {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $intended = $request->redirect_to;

        if ($intended) {
            $request->session()->put('url.intended', $intended);
        }

        return $next($request);
    }

}
