<?php

namespace App\Filament\Admin\Pages;

use App\Models\Place;
use App\Models\Vehicle;
use Filament\Pages\Page;

class SchipholPrices extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    protected static string $view = 'filament.pages.schiphol-prices';
    protected static ?int $navigationSort = 8;

    public $vehicles, $places, $prices;

    public $listeners = [
        'priceModified' => '$refresh',
    ];
    
    public function mount()
    {
        $this->vehicles = Vehicle::orderBy('id', 'asc')->get();
        $this->places = Place::with('vehicles')->get();

    }

}