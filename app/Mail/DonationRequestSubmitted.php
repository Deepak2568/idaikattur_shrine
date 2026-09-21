<?php

namespace App\Mail;

use App\Models\DonationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationRequestSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public DonationRequest $donation)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New donation interest: '.$this->donation->name,
            replyTo: [
                new Address($this->donation->email, $this->donation->name),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.donation-submitted',
        );
    }
}
