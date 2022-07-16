<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = '';

    public $msg;

    public function __construct($msg)
    {
        $this->msg = $msg;
        
    }

    public function build()
    {
        $user = \Auth::user();
        if($user->cliente->mail() && $user->cliente->mail() != '' && $user->cliente->nombreMail() && $user->cliente->nombreMail() != ''){
            return $this->subject($this->msg['titulo'])->from($user->cliente->mail(), $user->cliente->nombreMail())
            ->view('emails.pines.notificacion');
        } else {
            return $this->subject($this->msg['titulo'])
                        ->view('emails.pines.notificacion');
        }
    }
}
