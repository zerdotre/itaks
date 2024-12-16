<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;

class CreateReservation extends CreateRecord
{
    protected static string $resource = ReservationResource::class;

}