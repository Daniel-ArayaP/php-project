<?php

namespace App\Mail;

use App\Models\Levantamiento;
use App\Models\CarreraUlatina;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitudLevantamiento extends Mailable
{
    use Queueable, SerializesModels;

    public $levantamiento;
    public $career;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Levantamiento $levantamiento)
    {
        $this->levantamiento = $levantamiento;
        $this->career = CarreraUlatina::where('id_carreras_ulatina', 'SIS-001')->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.SolicitudLevantamiento')
                ->subject('Levantamiento de Requisitos: '.
                $this->levantamiento->carne_estudiante.' - '.
                $this->levantamiento->nombre_estudiante);
    }
}
