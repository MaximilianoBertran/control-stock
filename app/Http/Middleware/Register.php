<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Register extends Middleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards) {
        if ($request->tujm) {
            $this->authenticate($request, $guards);
        }

        return $next($request);
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards) {
        $guard = collect($guards)->get(0);
        if ($guard == 'api') {
            return response()->json([], 401);
        }
        $route = ($request->expectsJson() || $request->is('api/*')) ? null : route(Auth::guard($guard)->route('register'), ['tujm' => $request->tujm]);
        throw new AuthenticationException(
        'Unauthenticated.', $guards, $route
        );
    }

}
