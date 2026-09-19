<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Contact $contact)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New contact message: '.$this->contact->subject,
            replyTo: [
                new Address($this->contact->email, $this->contact->user_name),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-submitted',
        );
    }
}
