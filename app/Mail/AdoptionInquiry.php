<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdoptionInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $animal;
    public $user;

    public function __construct($animal, $user)
    {
        $this->animal = $animal;
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Adoption Inquiry for ' . $this->animal->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.inquiry',
        );
    }
}
