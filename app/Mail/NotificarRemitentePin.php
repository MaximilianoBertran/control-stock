<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificarRemitentePin extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = \Auth::user();
        if($user->cliente->mail() && $user->cliente->mail() != '' && $user->cliente->nombreMail() && $user->cliente->nombreMail() != ''){
            return $this->subject($this->msg['titulo'])->from($user->cliente->mail(), $user->cliente->nombreMail())
            ->view('emails.pines.notificacion_remitente_aprobado');
        } else {
            return $this->subject($this->msg['titulo'])
                        ->view('emails.pines.notificacion_remitente_aprobado');
        }
    }
}
