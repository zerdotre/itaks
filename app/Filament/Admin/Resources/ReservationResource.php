<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ReservationResource\Pages;
use App\Filament\Admin\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;
    protected static ?int $navigationSort = 0;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'name')
                    ->required(),
                DateTimePicker::make('datetime')
                    ->required(),
                TextInput::make('flightnr')
                    ->maxLength(10),
                TextInput::make('people')
                    ->required()
                    ->numeric(),
                Select::make('payment_method')
                    ->options(['cash'=>'cash', 'pin'=>'pin'])
                    ->required(),
                TextInput::make('luggage')
                    ->numeric()
                    ->required(),
                TextInput::make('hand_luggage')
                    ->numeric()
                    ->required(),
                Textarea::make('comments')
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->options(Reservation::$statuses)
                    ->required(),
                TextInput::make('google_calendar_event_id')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label(__('Customer')),
                Tables\Columns\TextColumn::make('reservation_datetime')
                    ->dateTime('d.m.Y H:i'),
                Tables\Columns\IconColumn::make('status')
            ])
            ->filters([
                //
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\OriginRelationManager::class,
            RelationManagers\DestinationRelationManager::class,
            RelationManagers\WaypointsRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservations::route('/'),
            'view' => Pages\ViewReservation::route('/{record}')
        ];
    }

    public static function canEdit(Model $record): bool{return false;}
    public static function canCreate(): bool{return false;}
}
