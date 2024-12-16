<?php

namespace App\Filament\Resources\ReservationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\TextColumn;

class DestinationRelationManager extends RelationManager
{
    protected static string $relationship = 'destination';

    protected static ?string $recordTitleAttribute = 'route';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('route'),
                TextColumn::make('street_number'),
                TextColumn::make('locality'),
            ]);
    }

    protected function canCreate(): bool { return false; }
    protected function canEdit(Model $record): bool { return false; }
    protected function canDelete(Model $record): bool{return false;}
    protected function canDeleteAny(): bool{ return false; }
    protected function isTablePaginationEnabled(): bool { return false; }
}
