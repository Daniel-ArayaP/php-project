<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectStatusChanged extends Mailable
{
    use Queueable, SerializesModels;
    public $statusName;
    public $title; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status, $title)
    {
        $this->statusName = $status;
        $this->title = $title; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ProjectStatusChanged')
                    ->subject('Cambio de estado');
    }
}
