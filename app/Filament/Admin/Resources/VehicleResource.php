<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VehicleResource\Pages;
use App\Filament\Admin\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use App\Forms\Components\MoneyInput;


class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationLabel = 'Voertuigen';
    protected static ?int $navigationSort = 10;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price_km')
                    ->required()->prefix('€'),
                TextInput::make('price_min')
                    ->required()->prefix('€'),
                TextInput::make('price_start')
                    ->required()->prefix('€'),
                TextInput::make('price_waypoint')
                    ->required()->prefix('€'),
                TextInput::make('price_minimum')
                    ->required()->prefix('€'),
                TextInput::make('max_people')->required(),
                TextInput::make('max_luggage')->required(),
                TextInput::make('max_handluggage')->required(),
                TextInput::make('max_combined_luggage')->required(),
                TextInput::make('label_1')->required(),
                TextInput::make('label_2')->required(),
                TextInput::make('label_3')->required(),
                TextInput::make('label_4')->required(),
                // if combined filled in, the combination of luggage+handluggage cannot exceed this
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('price_km')
                ->money('eur'),
                Tables\Columns\TextColumn::make('price_min')
                ->money('eur'),
                Tables\Columns\TextColumn::make('price_start')
                ->money('eur'),
                Tables\Columns\TextColumn::make('price_waypoint')
                ->money('eur'),
                Tables\Columns\TextColumn::make('price_minimum')
                ->money('eur'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }    
}
