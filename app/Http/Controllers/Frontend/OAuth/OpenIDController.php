<?php

namespace App\Http\Controllers\Frontend\OAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpenIDController extends Controller {

    /**
     * Show OpenID configuration.
     *
     */
    public function configuration(Request $request) {
        $data = [
            'issuer' => url(''),
            'authorization_endpoint' => route('passport.authorizations.authorize'),
            'token_endpoint' => route('passport.token'),
            'userinfo_endpoint' => route('api.user'),
        ];
        return response()->json($data, $status = 200,  $headers = [], $options = JSON_PRETTY_PRINT);
    }

}
