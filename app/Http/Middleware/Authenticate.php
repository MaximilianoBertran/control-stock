<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        $ruta = explode('/', request()->path());
        $guard = collect($guards)->get(0);
        $route = ($request->is('api/*')) ? null : route('login');
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $route
        );
    }
}
