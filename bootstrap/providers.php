<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FilamentHookServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\Filament\CentralAdminPanelProvider::class,
    App\Providers\TenancyServiceProvider::class,
    App\Providers\VoltServiceProvider::class,
    Barryvdh\Debugbar\ServiceProvider::class,
    GoogleMaps\ServiceProvider\GoogleMapsServiceProvider::class,
];
