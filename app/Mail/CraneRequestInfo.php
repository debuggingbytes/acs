<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class CraneRequestInfo extends Mailable
{
    use Queueable, SerializesModels;
    public $email, $crane;

    /**
     * Create a new message instance.
     * @param string $email
     * @param string $crane
     */
    public function __construct($email, $crane)
    {
        //
        $this->email = $email;
        $this->crane = $crane;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Crane Request Info',
            from: new Address('noreply@albertacraneservice.com', 'ACS Robot'),
            replyTo: [
                new Address($this->email)
            ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.request-crane',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
