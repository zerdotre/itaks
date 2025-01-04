<?php

namespace App\Filament\CentralAdmin\Resources\TenantResource\Pages;

use App\Filament\CentralAdmin\Resources\TenantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;
}
