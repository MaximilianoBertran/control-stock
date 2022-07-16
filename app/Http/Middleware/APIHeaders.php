<?php

namespace App\Http\Middleware;

use Closure;

class APIHeaders {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $response = $next($request);

        /**
         * CORS
         */
        $response->headers->remove('Access-Control-Allow-Origin');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->headers->remove("Access-Control-Allow-Credentials");
        $response->headers->set("Access-Control-Allow-Credentials", "true");

        $response->headers->remove("Access-Control-Allow-Methods");
        $response->headers->set("Access-Control-Allow-Methods", "GET, PUT, POST, DELETE, OPTIONS");

        $response->headers->remove("Access-Control-Max-Age");
        $response->headers->set("Access-Control-Max-Age", "1000");

        $response->headers->remove("Access-Control-Allow-Headers");
        $response->headers->set("Access-Control-Allow-Headers", "Origin, Content-Type, X-Auth-Token , Authorization");

        return $response;
    }

}
