<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MatrimonyRegistrationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Customer $customer)
    {
    }

    public function envelope(): Envelope
    {
        $name = trim($this->customer->fname.' '.$this->customer->lname);

        return new Envelope(
            subject: 'New matrimony registration: '.$name,
            replyTo: [
                new Address($this->customer->email, $name),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.matrimony-registered',
        );
    }
}
