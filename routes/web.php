<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

foreach (config('tenancy.central_domains') as $domain) {

    Route::domain($domain)->group(function () {

        Route::get('/', function () {
            return 'This is itaks.test, the id of the current tenant is ' . tenant('id');
        });
    
    });

}