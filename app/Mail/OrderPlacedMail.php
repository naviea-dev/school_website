<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserPlacedMail extends Mailable  implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $order;

    public function __construct(User $order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your User Confirmation - #' . $this->order->serial_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.placed',
            with: ['order' => $this->order]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
