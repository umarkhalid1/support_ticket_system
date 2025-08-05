<?php

namespace App\Mail;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyAdded extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ticket;
    public $reply;

    /**
     * Create a new message instance.
     */
    public function __construct(Ticket $ticket, TicketReply $reply)
    {
        $this->ticket = $ticket;
        $this->reply = $reply;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Message - ' . $this->ticket->title,
        );

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reply-added',
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
