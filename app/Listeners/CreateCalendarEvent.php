<?php

namespace App\Listeners;

use App\Events\ReservationCreated;
use App\Helpers\GCEvent;
use App\Models\Address;

class CreateCalendarEvent
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReservationCreated $rc): void
    {   
        GCEvent::createEventFromReservation($rc->reservation);
    }

}