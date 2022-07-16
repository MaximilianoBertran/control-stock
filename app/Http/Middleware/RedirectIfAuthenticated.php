<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;

class RedirectIfAuthenticated
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
        if (Auth::guard($guard)->check()) {
            
            $user = \Auth::user();
            if(Auth::user() && $user->isAdmin()){
                return redirect()->route('home');
            } else if(Auth::user() && !$user->isAdmin()){
                $urlAcceso = $user->cliente->url_acceso;
                return redirect()->route('home', ['urlAcceso' => $urlAcceso]);
            } else {
                return $next($request);
            }

        }

        return $next($request);
    }
}
