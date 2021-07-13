<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewProject extends Mailable
{
    use Queueable, SerializesModels;
    public $projectname;
    public $companyName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($projectname, $companyName)
    
    {
        $this->projectname=$projectname;
        $this->companyName=$companyName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.NewProject')
        ->subject('Nuevo proyecto creado');
    }
}
