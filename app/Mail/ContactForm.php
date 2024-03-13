<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;

    public $fullName;

    public $phone;

    public $comment;

    public function __construct($email, $fullName, $phone, $comment)
    {
        //
        $this->email = $email;
        $this->fullName = $fullName;
        $this->phone = $phone;
        $this->comment = $comment;
        $this->replyTo($this->email);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact', ['email' => $this->email, 'fullName' => $this->fullName, 'phone' => $this->phone, 'comment' => $this->comment]);
    }
}
