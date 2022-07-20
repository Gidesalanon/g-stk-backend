<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPassword extends Mailable
{
    use Queueable, SerializesModels;

  /**
     * Elements de contact
     * @var array
     */
    public $resetLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $resetLink)
    {
        $this->resetLink = $resetLink;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('jesuisjustevendeur@gmail.com')
        ->subject("Réinitialisation de mot de passe.") //
        ->view('emails.passwordReset');
    }
}
