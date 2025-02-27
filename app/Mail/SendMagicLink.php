<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMagicLink extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $token;
    protected $options;
    /**
     * Create a new message instance.
     */
    public function __construct($token, $options)
    {
        $this->token = $token;
        $this->options = $options;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Magic Link',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.send-magic-link',
            with: ['link' => $this->createLink()],
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

    protected function createLink()
    {
        return route('login.magic.login', ['token' => $this->token->token] + $this->options);
    }
}
