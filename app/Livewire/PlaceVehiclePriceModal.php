<?php

namespace App\Livewire;

use App\Models\Place;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Filament\Notifications\Notification; 

class PlaceVehiclePriceModal extends ModalComponent
{

    public $place_id, $place_name, $vehicle_id, $vehicle_name, $pivot_id, $price;

    public function mount($place_id, $vehicle_id)
    {   
        $place = Place::where('id', $place_id)->first();
        $this->place_name = $place->name;

        $vehicle = Vehicle::where('id', $vehicle_id)->first();
        $this->vehicle_name = $vehicle->name;
        
        $query = DB::select(
            'SELECT * FROM place_vehicle WHERE place_id=? AND vehicle_id=?',
            [$place_id, $vehicle_id]
        );

        if(!empty($query)){
            $query = $query[0];
            $this->pivot_id = $query->id;
            $this->price = $query->price;
        }else{
            $this->pivot_id = null;
            $this->price = 0;
        }

    }

    public function render()
    {
        return view('livewire.place-vehicle-price-modal');
    }

    public function save()
    {
        if($this->pivot_id) DB::update('UPDATE place_vehicle set price = ? WHERE id=?', [$this->price, $this->pivot_id]);
        else DB::insert('INSERT INTO place_vehicle (place_id, vehicle_id, price) VALUES (?, ?, ?)', [$this->place_id, $this->vehicle_id, $this->price]);

        Notification::make() 
            ->title('Saved successfully')
            ->success()
            ->send(); 
        
        $this->closeModalWithEvents([
            \App\Filament\Pages\SchipholPrices::class => 'priceModified',
        ]);

    }
    
    public function cancel()
    {
        $this->closeModal();
    }
}