<?php

namespace App\Livewire\Steps;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Spatie\LivewireWizard\Components\StepComponent;

class ThirdStepComponent extends StepComponent
{

    public $payment_method = 'Pin';
    public $chosen_vehicle;
    public $vehicles;

    protected $rules = [
        'chosen_vehicle' => 'required|integer'
    ];

    public function mount(Request $request)
    {
        // put a check in place for validating if session still has required data. Else forgetState()
        if(empty($this->state()->prices())){
            $this->forgetState($request);
            return redirect('/');
        }

        // put current state in session with each new step.
        $request->session()->put('state', $this->state()->all());

        $this->getVehicles();

        $this->dispatch('scroll-to-top');

    }

    public function render()
    {
        // select first, if not chosen.
        if(!$this->chosen_vehicle) $this->chosen_vehicle = $this->vehicles->keys()->first();

        return view('livewire.reservation-wizard.steps.third',[
            'count' => range(1, 8),
            'waypoint_data' => $this->state()->waypointData(),
            'prices' => $this->state()->prices(),
            'payment_methods' => ['Pin', 'Cash', 'Creditcard (+3,00)'],
        ]);
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Aanbiedingen',
            'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd" />
          </svg>'
        ];
    }

    public function submit()
    {
        $this->validate();

        $this->nextStep();
    }

    public function getVehicles()
    {
        $people = $this->state()->all()['second']['people'];
        $luggage = $this->state()->all()['second']['luggage'];
        $handluggage = $this->state()->all()['second']['handluggage'];

        $this->vehicles = Vehicle::where('max_people', '>=', $people)
        ->where('max_luggage', '>=', $luggage)
        ->where('max_handluggage', '>=', $handluggage)
        ->where('max_combined_luggage', '>=', $handluggage + $luggage)
        ->get()->keyBy('id');

        $vehicle_ids = $this->vehicles->pluck('id');

        if(!$vehicle_ids->contains($this->chosen_vehicle)) $this->chosen_vehicle = $this->vehicles->keys()->first();
    }

    // references: App\Helpers\CustomReservationWizardState::forgetState()
    public function forgetState(Request $request){ return $this->state()->forgetState($request); }
}