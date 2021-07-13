<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class notificationTutorAssigned extends Mailable
{
    use Queueable, SerializesModels;
    public $tutorEmail;
    public $tutorPhone;
    public $tutorName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tutorName,$tutorPhone,$tutorEmail)
    {
        $this->tutorEmail=$tutorEmail;
        $this->tutorPhone=$tutorPhone;
        $this->tutorName=$tutorName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.TutorAssignedStudent')
        ->subject('Tutor Asignado');
    }
}
