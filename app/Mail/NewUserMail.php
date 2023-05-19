<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    private Model $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Model $user)
    {
        $this->user   = $user;
    }
    
    public function build()
    {
        return $this->subject("Se dio de alta un nuevo contacto con el mail {$this->user->email}")
                    ->view('emails.send-notification')
                    ->with('usuario', $this->user);
    }
}
