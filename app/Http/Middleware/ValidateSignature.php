<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Middleware\ValidateSignature as Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateSignature extends Middleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Routing\Exceptions\InvalidSignatureException
     */
    public function handle($request, Closure $next) {
        if ($request->hasValidSignature()) {
            return $next($request);
        }

        throw new HttpException(403, 'This URL has expired');
    }

}
