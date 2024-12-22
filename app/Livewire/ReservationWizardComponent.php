<?php

namespace App\Livewire;

use App\Livewire\Steps\FrontStepComponent;
use App\Livewire\Steps\SecondStepComponent;
use App\Livewire\Steps\ThirdStepComponent;
use App\Livewire\Steps\FourthStepComponent;
use App\Livewire\Steps\FifthStepComponent;
use App\Helpers\CustomReservationWizardState;
use Spatie\LivewireWizard\Components\WizardComponent;

class ReservationWizardComponent extends WizardComponent
{

    public function steps() : array
    {
        return [
            FrontStepComponent::class,
            SecondStepComponent::class,
            ThirdStepComponent::class,
            FourthStepComponent::class,
        ];       
    }

    public function stateClass(): string
    {
        return CustomReservationWizardState::class;
    }

}