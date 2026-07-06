<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactReplyMail extends Mailable
{

    public Contact $contact;
    public string $replySubject;
    public string $replyMessage;

    public function __construct(
        Contact $contact,
        string $subject,
        string $message,
    ) {
        $this->contact = $contact;
        $this->replySubject = $subject;
        $this->replyMessage = $message;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: [$this->contact->email],
            subject: $this->replySubject,
            from: config('mail.from.address'),
            replyTo: [config('mail.from.address')],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-reply',
            with: [
                'name' => $this->contact->name ?? 'User',
                'message' => $this->replyMessage,
                'subject' => $this->replySubject,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
