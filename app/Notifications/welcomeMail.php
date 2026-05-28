<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class welcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('welcome@cattleflow.com', 'CattleFlow'),
            subject: 'Bem-vindo ao CattleFlow - Gerenciamento de Rebanho',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome', // Crie este arquivo em resources/views/emails/welcome.blade.php
        );
    }
}

