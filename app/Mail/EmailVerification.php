<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable {

    use Queueable;
    use SerializesModels;

    public $user;
    public $verificationUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $verificationUrl) {
        $this->user = $user;
        $this->verificationUrl = $verificationUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $prefix = config('mail.from.subject');
        return $this->view('emails.auth.email_verification')
                ->subject(($prefix ? "$prefix - "  : '') . __('Verify Email Address'))
        ;
    }

}
