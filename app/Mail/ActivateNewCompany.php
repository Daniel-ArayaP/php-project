<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivateNewCompany extends Mailable
{
    use Queueable, SerializesModels;

    public $userID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userid)
    {
        $this->userID = $userid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ActivacionEmpresa')
                    ->subject('Activar cuenta de ULatina');
    }
}
