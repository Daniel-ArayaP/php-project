<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CambiodeEstadoSolicitudAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $statusName;
    public $title;
    public $nombreCompletoStudent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status,$title,$nombreCompletoStudent)
    {
        $this->statusName = $status;
        $this->title = $title;
        $this->nombreCompletoStudent = $nombreCompletoStudent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            return $this->view('emails.CambiodeEstadoSolicitudAdmin')
        ->subject('Solicitud de estudiante declinada');

    }
}
