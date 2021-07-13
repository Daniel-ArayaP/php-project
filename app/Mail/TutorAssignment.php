<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TutorAssignment extends Mailable
{
    use Queueable, SerializesModels;

    public $tutorName;
    public $tutorEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email)
    {
        $this->tutorName = $name;
        $this->tutorEmail = $email; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.TutorAssignment')
                    ->subject('Asignación de Tutor');
    }
}
