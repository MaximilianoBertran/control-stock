<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller {

    use ResetsPasswords;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $user = User::where("email", $request->email)->first();
        $cliente = Cliente::where("id", $user->cliente_id)->first();

        return view('frontend.auth.passwords.reset')->with(['token' => $token, 'email' => $request->email])
                                                    ->with('urlAcceso', $cliente->url_acceso)
                                                    ->with('cliente', $cliente);
        
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @return string
     */
    protected function redirectTo() {
        return request()->session()->pull('url.intended', route(Auth::route('home')));
    }

}
