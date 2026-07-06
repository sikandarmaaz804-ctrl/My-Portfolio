<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactConfirmationMail extends Mailable
{

    public function __construct(
        public Contact $contact,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: [$this->contact->email],
            subject: 'We received your message - ' . config('app.name'),
            from: config('mail.from.address'),
            replyTo: [config('mail.from.address')],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-confirmation',
            with: [
                'name' => $this->contact->name ?? 'User',
                'subject' => $this->contact->subject,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
