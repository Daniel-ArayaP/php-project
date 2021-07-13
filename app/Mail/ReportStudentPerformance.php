<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportStudentPerformance extends Mailable
{
    use Queueable, SerializesModels;
public $studentname;
public $statusname;
public $projectname;
public $companyname;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($studentname,$statusname,$projectname,$companyname)
    {
        $this->studentname=$studentname;
        $this->statusname=$statusname;
        $this->projecname=$projectname;
        $this->companyname=$companyname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ReportStudentPerformance')
        ->subject('Actividad del estudiante en el proyecto');
    }
}
