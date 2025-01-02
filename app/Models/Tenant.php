<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public static function getCustomTenantDatabaseConnectionDetails(string $databaseName): array
    {
        \Log::info('Setting up tenant connection for: ' . $databaseName);
        return [
            'database' => database_path('tenants/' . $databaseName . '.sqlite'),
        ];
    }
}