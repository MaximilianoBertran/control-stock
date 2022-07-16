<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    protected function broker()
    {
        return Password::broker('admins');
    }

    protected function rules()
    {
        return [
            'token' => 'required', 
            'username' => 'required',
            'password' => 'required|confirmed|min:6',
        ];
    }
    
    public function showResetForm(Request $request, $token = null)
    {
        return view('backend.auth.passwords.reset')->with(
            ['token' => $token, 'username' => $request->username, 'user_type' => $request->user_type]
        );
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'username', 'password', 'password_confirmation', 'token'
        );
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
                    ->withInput($request->only('username'))
                    ->withErrors(['username' => trans($response)]);
    }

    protected $redirectTo = '/backend/login';
}
