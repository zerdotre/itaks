<?php

namespace App\Helpers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Spatie\LivewireWizard\Support\State;

class CustomReservationWizardState extends State
{
    public function waypointData(): array { return $this->forStep('front')['waypoint_data']; }
    public function prices(): array { return $this->forStep('front')['prices']; }
    public function reservationData(): array {
        return [
            'datetime' => $this->forStep('front')['datetime'],
            'flightnr' => $this->forStep('front')['flightnr'],
            
            'retour' => $this->forStep('front')['retour'],
            'retour_datetime' => $this->forStep('front')['retour_datetime'],
            'retour_flightnr' => $this->forStep('front')['retour_flightnr'],
        ];
    }

    public function getAllState()
    {
        $state = Helper::flatten_array_preserve_keys($this->all());

        unset(
            $state['label_1'],
            $state['label_2'],
            $state['label_3'],
            $state['label_4'],
            $state['0'],
            $state['1'],
            $state['2'],
            $state['3'],
            $state['stateClassName'],
            $state['stepName'],
            $state['icon'],
            $state['name'],
            $state['label'],
        );

        return $state;
    }

    public function forgetState(Request $request)
    {

        $request->session()->forget('state');

        return redirect()->route('home');

    }


    // public function deliveryAddress(): array
    // {
    //     $deliveryAddressStepState = $this->forStep('delivery-address');

    //     return [
    //         'name' => $deliveryAddressStepState['name'],
    //         'street' => $deliveryAddressStepState['street'],
    //         'zip' => $deliveryAddressStepState['zip'],
    //         'city' => $deliveryAddressStepState['city'],
    //     ];
    // }

    // public function amount(): int
    // {
    //     return $this->forStep('cart')['amount'];
    // }
}