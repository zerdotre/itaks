<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/test', function () {
        // dd(\App\Models\User::all());
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::get('/', function (Request $request) {

        $initialState = $request->session()->get('state');
        $stepName = $initialState ? array_key_last($initialState) : false;

        return view('home', compact('stepName', 'initialState'));

    })->name('home');


    Route::get('success', function(Request $request){
        
        // reset state after reservation complete.
        $request->session()->forget('state');

        return view('success');

    })->name('success');


    Route::get('annuleren/{rand_id}', function(string $rand_id){

        if($reservation = App\Models\Reservation::where('rand_id', $rand_id)->first()){

            $reservation->status = 'cancelled';
            $reservation->save();

            return view('cancelled');

        }

    })->name('cancelled');


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/adressen', [App\Http\Controllers\DashboardController::class, 'addresses'])->name('addresses');
        Route::post('/adressen', [App\Http\Controllers\DashboardController::class, 'destroyAddress'])->name('addresses.delete');
    });

    require __DIR__.'/auth.php';

});
