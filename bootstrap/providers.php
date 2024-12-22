<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\Filament\ItaksadminPanelProvider::class,
    App\Providers\VoltServiceProvider::class,
    App\Providers\TenancyServiceProvider::class,
    
    App\Providers\FilamentHookServiceProvider::class,
    GoogleMaps\ServiceProvider\GoogleMapsServiceProvider::class,
];
