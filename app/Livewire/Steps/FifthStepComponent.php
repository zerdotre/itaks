<?php

namespace App\Livewire\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class FifthStepComponent extends StepComponent
{
    public function render()
    {
        return view('livewire.reservation-wizard.steps.fifth');
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Contactgegevens',
            'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
          </svg>'
        ];
    }
}