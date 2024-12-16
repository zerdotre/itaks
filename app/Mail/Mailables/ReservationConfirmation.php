<?php

namespace App\Mail\Mailables;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmation extends Mailable
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
            subject: 'Bevestiging reservering ' . env('APP_NAME'),
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
            view: 'emails.confirmation-customer',
            with: [
                'retour' => $retour
            ]
        );
    }
}