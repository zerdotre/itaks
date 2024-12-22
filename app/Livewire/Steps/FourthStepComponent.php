<?php

namespace App\Livewire\Steps;

use App\Helpers\GCEvent;
use App\Models\Address;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Google\Service\Calendar\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\LivewireWizard\Components\StepComponent;

class FourthStepComponent extends StepComponent
{

    public $vehicle_id, $vehicle_name;
    public $name, $phone, $email, $comments, $password;

    public function mount(Request $request)
    {
        // put current state in session with each new step.
        $request->session()->put('state', $this->state()->all());

        if(auth()->check()){

            $this->fill(auth()->user());

        }

        $this->vehicle_id = $this->state()->forStep('third')['chosen_vehicle'];
        
        $this->vehicle_name = Vehicle::find($this->vehicle_id)->name;
    }

    public function render()
    {
        return view('livewire.reservation-wizard.steps.fourth', [
            'waypoint_data' => $this->state()->waypointData(),
            'prices' => $this->state()->prices(),
            'reservation_data' => $this->state()->reservationData(),
        ]);
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Contactgegevens',
            'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
          </svg>'
        ];
    }

    public function submit()
    {
        $this->validate();

        $data = $this->state()->all();

        // first create origin & destination addresses
        $origin         = Address::updateOrCreate(
            ['user_id' => $user->id, 'place_id' => $data['front']['waypoint_data']['from']['place_id']],
            $data['front']['waypoint_data']['from']
        );
        
        $destination    = Address::updateOrCreate(
            ['user_id' => $user->id, 'place_id' => $data['front']['waypoint_data']['to']['place_id']],
            $data['front']['waypoint_data']['to']
        );

        // if has retour, first create retour-reservation
        if($data['front']['retour']):

            $retour = new Reservation;
            $retour->user_id        = $user->id;
            $retour->rand_id        = Reservation::generateRandId();
            $retour->vehicle_id     = $data['third']['chosen_vehicle'];
            $retour->people         = $data['second']['people'];
            $retour->datetime       = $data['front']['retour_datetime'];
            $retour->flightnr       = $data['front']['retour_flightnr'];
            $retour->payment_method = $data['third']['payment_method'];
            $retour->luggage        = $data['second']['luggage'];
            $retour->handluggage    = $data['second']['handluggage'];
            $retour->comments       = $data['fourth']['comments'];
            $retour->distance       = round($data['front']['distance']);
            $retour->duration       = ceil($data['front']['duration']);
            $retour->price          = $data['front']['prices'][$data['third']['chosen_vehicle']]['total'];

            $retour->is_retour      = 1;

            $retour->origin_id      = $destination->id;
            $retour->destination_id = $origin->id;

            $retour->save();
            
        endif;

        // Put reservation in db
        $reservation = new Reservation;
        $reservation->user_id           = $user->id;
        $reservation->rand_id           = Reservation::generateRandId();
        $reservation->vehicle_id        = $data['third']['chosen_vehicle'];
        $reservation->people            = $data['second']['people'];
        $reservation->datetime          = $data['front']['datetime'];
        $reservation->flightnr          = $data['front']['flightnr'];
        $reservation->payment_method    = $data['third']['payment_method'];
        $reservation->luggage           = $data['second']['luggage'];
        $reservation->handluggage       = $data['second']['handluggage'];
        $reservation->comments          = $data['fourth']['comments'];
        $reservation->distance          = $data['front']['distance'];
        $reservation->duration          = $data['front']['duration'];
        $reservation->price             = $data['front']['prices'][$data['third']['chosen_vehicle']]['total'];

        $reservation->origin_id         = $origin->id;
        $reservation->destination_id    = $destination->id;
        
        if($data['front']['retour']){
            
            if(!$retour) throw new Exception("Error Processing Request, No retour created.", 1);
            
            $reservation->retour_id = $retour->id;

        }
        
        $reservation->save();

        // if has waypoints, insert, and link into reservation_waypoint pivot table.
        if($data['front']['has_waypoints']){

            $waypoints = $data['front']['waypoint_data'];
            unset($waypoints['from'], $waypoints['to']);

            $waypoint_addresses = [];

            foreach ($waypoints as $key => $waypoint) {

                // insert into addresses, and pivot table [reservation_waypoint]
                $waypoint_addresses[$key] = Address::create($waypoint);

                // insert into pivot with reservation->id
                $reservation->waypoints()->attach($waypoint_addresses[$key]->id);

            }

            if($data['front']['retour'] && !empty($retour)){
                
                // if retour attach waypoints in reverse
                $waypoint_addresses = array_reverse($waypoint_addresses);

                foreach ($waypoint_addresses as $waypoint) {
                    $retour->waypoints()->attach($waypoint->id);
                }
            }
            
        }

        // Google Calendar Event
        $gcevent = GCEvent::createEventFromReservation($reservation);

        // send confirmation to customer
        Mail::to($reservation->user->email)->send(new \App\Mail\ReservationConfirmation($reservation));
        
        // send confirmation to admin
        Mail::to(config('mail.from.address'))
            ->cc('info@haarlemsetaxicentrale.nl')
            ->send(new \App\Mail\NewReservation($reservation));

        if($data['front']['retour'] && !empty($retour)){

            // Create retour event
            $retour_event = GCEvent::createEventFromReservation($retour);

            // send confirmation to customer
            // Mail::to($reservation->user->email)->send(new \App\Mail\ReservationConfirmation($retour));

            // send confirmation to admin
            // Mail::to(config('mail.from.address'))->send(new \App\Mail\NewReservation($retour));
        }

        // redirect to success page
        redirect()->route('success');

    }

    // references: App\Helpers\CustomReservationWizardState::forgetState()
    public function forgetState(Request $request){ return $this->state()->forgetState($request); }

    public function rules()
    {
        return [
            'name'   => 'required',
            'phone'  => 'required',
            'email'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name' => 'Het naam veld is verplicht.',
            'phone' => 'Het telefoonnummer veld is verplicht.',
            'email' => 'Het E-mailadres veld is verplicht.'
        ];
    }

}