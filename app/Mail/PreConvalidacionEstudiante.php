<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PreConvalidacionEstudiante extends Mailable
{
    use Queueable, SerializesModels;

   public $full_name;
   public $cod_estudiante;
   public $carrera;
   public $cod_convalidacion;
   public $fecha_preconvalidacion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($full_name, $cod_estudiante , $carrera, $cod_convalidacion, $fecha_preconvalidacion)
    {
        $this->full_name = $full_name;
        $this->cod_estudiante = $cod_estudiante;
        $this->carrera = $carrera;
        $this->cod_convalidacion = $cod_convalidacion;
        $this->fecha_preconvalidacion = $fecha_preconvalidacion;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.PreConvalidacionEstudiante')->subject('Preconvalidacion de Estudiante');
    }
}

