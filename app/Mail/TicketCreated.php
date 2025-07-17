<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    /**
     * Create a new message instance.
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
    public function build()
    {
        return $this->markdown('emails.ticket-created')
            ->subject('New Ticket Created - ' . $this->ticket->title)
            ->with([
                'ticket' => $this->ticket,
            ]);
    }
}
