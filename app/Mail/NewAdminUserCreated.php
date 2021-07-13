<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class NewAdminUserCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;
    public $URL;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usr, $pass)
    {
        $this->user = $usr;
        $this->password = $pass;
        $this->URL = URL::to('/');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.NewAdminUserCreated')
                    ->subject('Usuario Creado');
    }
}
