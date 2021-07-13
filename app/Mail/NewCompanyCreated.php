<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Company;

class NewCompanyCreated extends Mailable
{
    use Queueable, SerializesModels;
public $Company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Company)

    {
        //
        $this->Company=$Company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.NewCompanyCreated')
                    ->subject('Se ha creado una nueva empresa');
    }
}
