<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Estado de curso';
    public $course;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($course,$email)
    {
        $this->course = $course;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.course_status');
    }
}
