<?php
namespace App\Helpers;

use App\Helpers\Helper;
use App\Models\Address;
use App\Models\Reservation;
use App\Models\Vehicle;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;
use DateTime;

class GCEvent{

    public static function createEventFromReservation(Reservation $reservation)
    {
        $vehicles = Vehicle::all()->keyBy('id');

        // format addresses
        $origin         = self::formatAddress($reservation->origin);
        $destination    = self::formatAddress($reservation->destination);

        // has waypoints?
        if(!$reservation->waypoints->isEmpty()){
            
            $waypoints = [];
            
            foreach ($reservation->waypoints as $waypoint) {
                $waypoints[] = self::formatAddress($waypoint);
            }

        }

        // Google Calendar Event
        $event = new Event;
        $event->name            = (!empty($reservation->origin->route) && !empty($reservation->origin->street_number) ? $reservation->origin->route . ' ' .$reservation->origin->street_number : $reservation->origin->locality);
        $event->name            .= ' naar ';
        $event->name            .= (!empty($reservation->destination->route) && !empty($reservation->destination->street_number) ? $reservation->destination->route.' ' .$reservation->destination->street_number.', '.$reservation->destination->locality : $reservation->destination->locality);
        $event->location        = $reservation->origin->locality;
        $event->startDateTime   = new Carbon($reservation->datetime);
        $event->endDateTime     = new Carbon($reservation->datetime);
        $event->description     = 'Van: '.$origin;
            
        if(!empty($waypoints)){ foreach($waypoints as $waypoint){
            $event->description .= '
Tussenstop: '.$waypoint;

        } };

$event->description .= '
Naar: '.$destination.'

Datum: '. (new DateTime($reservation->datetime))->format('d.m.Y H:i').'
Prijs: '. Helper::strfmon($reservation->price) .'
Betaalmethode: '.$reservation->payment_method.'
Voertuig: '.$vehicles[$reservation->vehicle_id]->name.'
Aantal personen: '.$reservation->people.
($reservation->handluggage ? '
Handbagage: '.$reservation->handluggage : '').
($reservation->luggage ? '
Koffers: '.$reservation->luggage : '').
($reservation->comments ? '
Opmerkingen: '.$reservation->comments : '').
($reservation->flightnr ? '
Vluchtnr: '.$reservation->flightnr : '').'

Naam: '.$reservation->user->name.'
Telefoon: '.$reservation->user->phone;
        
        $event->save();

        // save event id to reservation
        $reservation->google_calendar_event_id = $event->id;
        
        $reservation->save();
    }

    public static function formatAddress(Address $address)
    {
        if($address->type == 'airport' || empty($address->route)){
            
            $address_str = $address->locality;

        }
        else{

            $address_str = $address->route.' '.($address->street_number ?? '').', '.$address->postal_code.' '.$address->locality;

        }

        return $address_str;
    }

}