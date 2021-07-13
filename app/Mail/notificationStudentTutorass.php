<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class notificationStudentTutorass extends Mailable
{
    use Queueable, SerializesModels;
    public $studentName;
    public $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($studentName,$project)
    {
        
        $this->studentName=$studentName;
        $this->project=$project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.StudentAssigned')
        ->subject('Asignacion de estudiante');
    }
}
