<?php

namespace App\Filament\Admin\Resources\ReservationResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\TextColumn;


class OriginRelationManager extends RelationManager
{
    protected static string $relationship = 'origin';
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
