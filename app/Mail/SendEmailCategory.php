<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailCategory extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    public $user;
    /**
     * @var
     */
    public $category;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $category)
    {
        //
        $this->user = $user;
        $this->category = $category;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.correo3')
            ->subject('Se ha creado una nueva categoria');
    }
}
