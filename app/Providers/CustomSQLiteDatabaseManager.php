<?php

namespace App\Providers;

use Stancl\Tenancy\Database\TenantDatabaseManager\SQLiteDatabaseManager;

class CustomSQLiteDatabaseManager extends SQLiteDatabaseManager
{
    public function makeConnectionConfig(string $databaseName): array
    {
        \Log::info('Making connection config for: ' . $databaseName);
        $config = parent::makeConnectionConfig($databaseName);
        $config['database'] = database_path('tenants/' . $databaseName . '.sqlite');
        return $config;
    }
}