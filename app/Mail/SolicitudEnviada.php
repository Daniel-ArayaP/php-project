<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;

ini_set('memory_limit', '512M');

class SolicitudEnviada extends Mailable
{
    use Queueable, SerializesModels;
    public $Student;
    public $Curriculum;
    public $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Student, $Curriculum, $project)
    {
        $this->Student = $Student;
        $this->Curriculum = $Curriculum;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if ($this->Curriculum == null) {
            return $this->view('emails.SolicitudEnviada')
                ->subject('Solicitud de estudiante');


        } else {
            return $this->view('emails.SolicitudEnviada')
                ->subject('Solicitud de estudiante')
                ->attach(storage_path('app/public/'.$this->Curriculum.''),[
                    'mime' => 'application/pdf',
                ]);

        }
    }
}
