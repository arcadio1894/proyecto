<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailTest extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    //private $name;
    /**
     * @var
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.correo2')
            //->from('correo@gmail.com', 'name')
            ->subject('Correo de prueba usando Mailables')
            ->attach('assets/prueba.pdf', array(
                'as' => 'PdfReport.pdf',
                'mime' => 'application/pdf'
            ));

    }
}
