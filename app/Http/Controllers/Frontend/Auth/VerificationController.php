<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller {

    use VerifiesEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {

        if ($request->user()->hasVerifiedEmail()) {
            return $this->verified($request);
        }

        $diff = \Carbon\Carbon::now()->addSeconds(1 + 60 * config('auth.verification.expire', 60))->longAbsoluteDiffForHumans();
        return view('frontend.auth.verify')
                ->with('diff', $diff)
        ;
    }

    /**
     * Where to redirect users after verification.
     *
     * @return string
     */
    protected function redirectTo() {
        return route('home');
    }

    protected function verified() {
        return redirect($this->redirectPath());
    }
}
