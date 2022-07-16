<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected function broker()
    {
        return Password::broker('admins');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['username' => 'required'], ['username.required' => 'Please enter your username.']);

        $response = $this->broker()->sendResetLink(
            $request->only('username')
        );

        if ($response === Password::RESET_LINK_SENT) {
            return back()->with('status', trans($response));
        }

        return back()->withErrors(
            ['email' => trans($response)]
        );
    }

    public function showLinkRequestForm()

    {

        return view('backend.auth.passwords.email')->with('user_type', request()->user_type);

    }


}
