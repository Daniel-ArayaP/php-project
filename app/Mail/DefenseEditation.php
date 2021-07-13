<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DefenseEditation extends Mailable
{
    use Queueable, SerializesModels;
    public $academicRep;
    public $reader;
    public $date;
    public $time;
    public $classroom;
    public $student;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rep, $read, $dt, $tm, $clr, $stu)
    {
        $this->academicRep = $rep;
        $this->reader = $read;
        $this->date = $dt;
        $this->time = $tm;
        $this->classroom = $clr;
        $this->student = $stu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.DefenseEditation')
                    ->subject('Cambios en la Defensa');
    }
}
