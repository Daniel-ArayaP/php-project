<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CambiodeEstadoSolicitud extends Mailable
{
    use Queueable, SerializesModels;
    public $statusName;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status,$title)
    {
        $this->statusName = $status;
        $this->title=$title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->statusName=='Aceptada'){
            return $this->view('emails.CambiodeEstadoSolicitud')
        ->subject('Cambio en el estado de la solicitud');

        }else{
            return $this->view('emails.CambiodeEstadoSolicitud')
        ->subject('Cambio en el estado de la solicitud');

        }
        
    }
}
