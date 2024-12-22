<?php

namespace App\Livewire\Steps;

use App\Helpers\Helper;
use App\Models\Address;
use App\Models\Place;
use App\Models\Vehicle;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On; 
use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\LivewireWizard\Support\State;

class FrontStepComponent extends StepComponent
{

    public $waypoints; // input
    public $datetime, $flightnr, $retour = false, $retour_datetime, $retour_flightnr;
    public $waypoint_data = []; // geocoding result with address_components
    public $prices, $has_waypoints = false, $distance, $duration; // has at least 1 waypoint besides origin/destination
    public $addresses = false, $showChooseAddressModal = false, $waypoint_currently_editing, $chosenAddressId; // for chooseFromAddressesModal
    public $origin_is_airport = false;
    public $destination_is_airport = false;


    public function stepInfo(): array
    {
        return [
            'label' => 'Reisgegevens',
            'icon'  => '<path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />'
        ];
    }

    public function mount(Request $request)
    {
        // put current state in session with each new step.
        // $request->session()->put('state', $this->state()->all());
        $request->session()->forget('state');
        
        if(auth()->check()){

            if(!auth()->user()->addresses->isEmpty()) $this->addresses = auth()->user()->addresses;

        }

        $this->waypoints = [
            $this->getWaypointElement(['name' => 'from', 'label' => 'van']),
            $this->getWaypointElement(['name' => 'to', 'label' => 'naar',
            'icon' => '<span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"></path>
            </svg>
        </span>'])
        ];
    }

    public function render()
    {
        return view('livewire.reservation-wizard.steps.front');
    }

    /*
     * This method is only fired when an address from googleAutocomplete is chosen.
     * In such case, also remove possible address_id from waypoint.
    */
    #[On('waypoint-updated')]
    public function waypointUpdated($key, $address)
    {
        // If customer wants to be pickedup from an airport, then let them type in flightnr.
        // if key == 0, so 'from'
        if($key < 1){
            if(str_contains(strtolower($address), 'schiphol') || str_contains(strtolower($address), 'airport')){
                $this->origin_is_airport = true;
            }

        // if key is last so destination. Then let them choose 'retour'
        }elseif($key == array_key_last($this->waypoints)){
            if(str_contains(strtolower($address), 'schiphol') || str_contains(strtolower($address), 'airport')){
                $this->destination_is_airport = true;
            }
        }

        $this->waypoints[$key]['value'] = $address;

        // to remove possible address_id from this waypoint.
        unset($this->waypoints[$key]['address_id']);

    }

    // This submit function uses js to only get waypoints in as argument.
    // So other fields are retrieved via livewire models.
    public function submit($formData)
    {
        // to prevent submission wo date & time
        $this->validate();

        // We only remove unwanted variables from the $formData submitted formdata. The datetime etc data is already stored in the global variables. eg: $this->datetime.
        // We do this because we only want the waypoints.
        unset($formData['datetime'], $formData['flightnr'], $formData['retour'], $formData['retour_datetime'], $formData['retour_flightnr']);

        foreach($formData as $key => $waypoint){

            /*
             * The waypoints, and waypoint_data have different keys. The waypoints array is for input, so to create the inputfields.
             * The waypoint_data array, is to get data from Geolocations-service for this point.
             * This data is stored in the db, so if an address is chosen from the users addressbook, well want to retrieve this data instead of 
             * retrieving from Geolocations-service. 
             * waypoints array keys are regular: 0,1,2,... While the formData keys look like below. 
             * "from" => ...
             * "waypoint_1" => ...
             * "waypoint_2" => ...
             * "to" => ..
             * 
             * Ofcourse this could be refactored to make the keys uniform.
            */
            if ($key === array_key_first($formData)) $waypoints_array_key = 0;
            elseif($key === array_key_last($formData)) $waypoints_array_key = array_key_last($this->waypoints);
            else $waypoints_array_key = str_replace('waypoint_', '', $key);

            // if chosen from Addressbook get address
            if(isset($this->waypoints[$waypoints_array_key]['address_id'])){

                $this->waypoint_data[$key] = Address::where('user_id', auth()->user()->id)->where('id', $this->waypoints[$waypoints_array_key]['address_id'])->first();

            }
            
            // if submitted field is empty, return error.
            else{
                
                if(empty($waypoint)){
                    $this->addError($key, 'Dit adres is niet compleet.');
                    return;
                }

                $this->waypoint_data[$key] = $this->getPlace($waypoint);

            }
            
            // if empty str (/erroneous address), getPlace() returns void/null. Directly throw error and dont continue
            if(!$this->waypoint_data[$key]){
                $this->addError($key, 'Dit adres is niet compleet.');
                return;
            }

            // check if all data is correctly filled in (housenumber only when type=premise).
            if(
                $this->waypoint_data[$key]['type'] == 'premise' ||
                $this->waypoint_data[$key]['type'] == 'route' ||
                $this->waypoint_data[$key]['type'] == 'street_address' ||
                $this->waypoint_data[$key]['type'] == 'postal_code'
            ){
                
                // check if not schiphol
                $address_str = strtolower(implode(" ", $this->waypoint_data[$key]));
                if(!str_contains($address_str, 'schiphol')){

                    if(!isset($this->waypoint_data[$key]['street_number'])) $this->addError($key, 'Dit adres mist een huisnummer.');

                }
            }
            if(!isset($this->waypoint_data[$key]['locality'])) $this->addError($key, 'Dit adres is niet compleet. Geen plaats.'); // plaats
            if(!isset($this->waypoint_data[$key]['postal_code'])) $this->addError($key, 'Dit adres is niet compleet. Geen postcode.'); // postcode

            // if there is any error, dont continue, but return with errorbag to form.
            if(!$this->getErrorBag()->isEmpty()) return;

        }

        $directions = $this->getDirections();

        $this->distance = $directions['total_distance'];
        $this->duration = $directions['total_duration'];

        $this->calculatePrices($directions);

        $this->nextStep();

    }

    public function calculatePrices($directions)
    {
        // should we continue to calculate prices? or simply choose from list.
        $calculate_prices = true;

        // if schipholrit, which end is schiphol? origin/destination
        $schiphol_point = null;

        // count waypoints other than origin/destination
        $waypoint_count = count($this->waypoint_data) - 2;

        // retrieve all vehicles
        $vehicles = Vehicle::all()->keyBy('id');

        // if we have waypoints (other than from-to), load vehicles because we're gonna need it.
        // Else only load if calculation is needed.
        if($waypoint_count > 0){

            $this->has_waypoints = true;

        }

        // Is this a schipholrit?
        if($this->waypoint_data['from']['type'] == 'airport' || $this->waypoint_data['from']['locality'] == 'Schiphol') $schiphol_point = 'from';
        elseif($this->waypoint_data['to']['type'] == 'airport' || $this->waypoint_data['to']['locality'] == 'Schiphol') $schiphol_point = 'to';
    
        // IF this is a schipholrit
        if($schiphol_point){

            // opposite point is 'from' if schiphol=='to', and is 'to' if schiphol=='from'
            $opposite_point = ($schiphol_point == 'from' ? 'to' : 'from');

            // get opposite point locality & zipcode from waypoint_data
            $opposite_locality  = $this->waypoint_data[$opposite_point]['locality'];
            $opposite_zipcode   = substr($this->waypoint_data[$opposite_point]['postal_code'], 0, 4);

            // check if opposite point is in default prices list
            // returns Model if found, else null
            $default_price = Place::where(function($query) use ($opposite_zipcode){
                $query->where('type', 'zipcode');
                $query->where('name', $opposite_zipcode);
            })->first();

            //second check is for zipcoderange
            if(!$default_price){
                $default_price = Place::where(function($query) use ($opposite_zipcode){
                    $query->where('type', 'zipcoderange');
                    $query->where('name', '<=', $opposite_zipcode);
                    $query->where('zipcoderange_to', '>=', $opposite_zipcode);
                })->first();
            }

            if(!$default_price){
                $default_price = Place::where(function($query) use ($opposite_locality){
                    $query->where('type', 'place');
                    $query->where('name', $opposite_locality);
                })->first();
            }

            // if we have a default price, get price for all vehicles
            if($default_price){
                
                // retrieves prices for all vehicles for this place.
                $default_prices = DB::table('place_vehicle')
                ->selectRaw('vehicle_id, price / 100 as subtotal')
                ->where('place_id', $default_price->id)
                ->get();
                

                if(!$default_prices->isEmpty()){
                    
                    // keyBy vehicle_id. 
                    $default_prices = $default_prices->map( fn($item) => (array) $item )->keyBy('vehicle_id')->all();

                    // if has waypoints, always calculate to later compare.
                    $calculate_prices = ($this->has_waypoints ? true : false );
                }

            }

        }

        // if no default price is possible, calculate based on distanced & time / vehicle.
        // if has_waypoints, always calculate based on distance AND compare to list price. Pick higher one.
        if($calculate_prices){

            $calculated_prices = [];

            foreach($vehicles as $vehicle){
            
                $calculated_prices[$vehicle->id] = Helper::computePriceForVehicle($vehicle, $directions['total_distance'], $directions['total_duration']);

                // check if minimum price is met, if not select minimumprice.
                $calculated_prices[$vehicle->id]['subtotal'] = max($calculated_prices[$vehicle->id]['subtotal'], $vehicle->price_minimum/100);
            
            }

        }


        // begin processing for resulting $prices array
        $prices = [];

        // if has waypoints, and is schipholrit (so we have default_prices and $calculated_prices): COMPARE & take the higher price.
        // This could be a ride not from/to schiphol so we only have calculated_prices, then no compare should take place.
        if($this->has_waypoints && !empty($calculated_prices) && !empty($default_prices)){

            foreach ($vehicles as $vehicle) {

                $prices[$vehicle->id] = [];
                $prices[$vehicle->id]['subtotal'] = max($calculated_prices[$vehicle->id]['subtotal'], $default_prices[$vehicle->id]['subtotal']);

            }

        }elseif(!empty($default_prices)) $prices = $default_prices;
        else $prices = $calculated_prices;


        // add waypoints, and calculate totals
        if($this->has_waypoints){

            foreach ($vehicles as $vehicle) {
                $prices[$vehicle->id]['waypoint_count']  = $waypoint_count;
                $prices[$vehicle->id]['price_waypoints'] = Helper::intfflo($vehicle->price_waypoint * $waypoint_count);
                $prices[$vehicle->id]['total']           = (int) (ceil($prices[$vehicle->id]['subtotal'] + $prices[$vehicle->id]['price_waypoints'])*100);
            }

        }else{

            foreach ($vehicles as $vehicle) {
    
                $prices[$vehicle->id]['total'] = (int) (ceil($prices[$vehicle->id]['subtotal']) * 100);
    
            }

        }

        $this->prices = $prices;

    }

    public function getDirections()
    {   
        $waypoints = $this->waypoints;
        array_shift($waypoints);
        array_pop($waypoints);
        $waypoints = array_column($waypoints, 'value');

        $request_params = [
            'origin'        => $this->waypoints[0]['value'],
            'waypoints'     => $waypoints,
            'destination'   => end($this->waypoints)['value'],
            'language'      => 'nl',
            'travelMode'    => 'DRIVING',
        ];

        $response = \GoogleMaps::load('directions')
            ->setParam($request_params)
            ->get();

        $response = json_decode($response);

        // dd($response);

        // dd(Helper::computeTotalDistance($response));
        
        return Helper::computeTotalDistance($response);
    }

    public function getPlace($address)
    {
        $response = \GoogleMaps::load('geocoding')
            ->setParam(['address'=>$address])
            ->get();
        $response = json_decode($response);
    
        if($response->status=="OK"){

            return Helper::getComponentsFromResponse($response);
            
        }
    }

    public function addWaypoint()
    {   
        $from = array_shift($this->waypoints);
        $to = array_pop($this->waypoints);

        $key = count($this->waypoints) + 1; // existing waypoints
        
        // add new waypoint to waypoints-array
        $this->waypoints[$key] = $this->getWaypointElement([
            'name'  => 'waypoint_'.$key,
            'label' => 'via'
        ]);

        array_unshift($this->waypoints, $from); // prepend from to waypoints array
        $this->waypoints[] = $to; // append $to to waypoints array

        $this->emit('waypointAdded');
    }
    
    public function removeWaypoint($key)
    {
        unset($this->waypoints[$key]);
        $this->emit('waypointRemoved', $key);
    }


    /*
     * ['name' =>, 'label'=>, 'icon' => false, 'value' = null]
    */
    public function getWaypointElement(array $waypoint_data)
    {   
        $a = [
            'name'  => $waypoint_data['name'],
            'label' => $waypoint_data['label'],
            'icon'  => $waypoint_data['icon'] ?? '
            <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>          
            </span>',
            'value' => $waypoint_data['value'] ?? ''];

        return $a;
    }

    /*
    * Set editing_waypoint_name,
    * Open modal with select with addresses.
    * accepts key for $this->waypoints array.
    */
    public function chooseAddress(){
        
        $address = Address::where('user_id', auth()->user()->id)->where('id', $this->chosenAddressId)->first();
        
        if($address){
        
            $this->waypoints[$this->waypoint_currently_editing]['value'] = $address->type=='airport' ? $address->locality : $address->route .' '.$address->street_number;
        
            $this->waypoints[$this->waypoint_currently_editing]['address_id'] = $address->id;

        }
        
        $this->showChooseAddressModal = false;

    }

    public function setWaypointCurrentlyEditing($key)
    {
        $this->waypoint_currently_editing = $key;
        $this->showChooseAddressModal = true;
        return;
    }

    public function rules()
    {
        $rules = ['datetime' => 'required'];

        if($this->retour) $rules['retour_datetime'] = 'required';

        $rules = ['flightnr' => 'string|max:10|nullable'];
        $rules = ['retour_flightnr' => 'string|max:10|nullable'];

        return $rules;
    }

    public function messages()
    {
        return [
            'datetime.required' => 'Ophaalmoment is verplicht',
            'datetime_retour.required' => 'Ophaalmoment retour is verplicht'
        ];
    }

    // references: App\Helpers\CustomReservationWizardState::forgetState()
    public function forgetState(Request $request){ return $this->state()->forgetState($request); }


}