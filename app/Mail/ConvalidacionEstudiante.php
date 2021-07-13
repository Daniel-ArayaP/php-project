<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConvalidacionEstudiante extends Mailable
{
    use Queueable, SerializesModels;

    public $full_name;
    public $carrera;
    protected $nameFile;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($full_name, $carrera, $nameFile)
    {
        $this->full_name = $full_name;
        $this->carrera = $carrera;
        $this->nameFile = $nameFile;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ConvalidacionEstudiante')->subject("Convalidaciones de estudiante")->attach(storage_path('app/public/convalidacion/'.$this->nameFile));
    }
}
