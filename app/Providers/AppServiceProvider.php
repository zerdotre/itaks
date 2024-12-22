<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Livewire\ReservationWizardComponent;
use App\Livewire\Steps\FrontStepComponent;
use App\Livewire\Steps\SecondStepComponent;
use App\Livewire\Steps\ThirdStepComponent;
use App\Livewire\Steps\FourthStepComponent;
use App\Livewire\Steps\FifthStepComponent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('reservation-wizard', ReservationWizardComponent::class);
        Livewire::component('front', FrontStepComponent::class);
        Livewire::component('second', SecondStepComponent::class);
        Livewire::component('third', ThirdStepComponent::class);
        Livewire::component('fourth', FourthStepComponent::class);
        Livewire::component('fifth', FifthStepComponent::class);

    }
}
