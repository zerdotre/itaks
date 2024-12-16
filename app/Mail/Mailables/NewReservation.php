<?php

namespace App\Mail\Mailables;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewReservation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Reservation $reservation,
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservering taxi Schiphol 24/7',
            replyTo: [
                new Address($this->reservation->user->email, $this->reservation->user->name),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $retour = null;
        if($this->reservation->retour_id) $retour = Reservation::find($this->reservation->retour_id);

        return new Content(
            view: 'emails.confirmation-admin',
            with: [
                'retour' => $retour
            ]
        );
    }
}
