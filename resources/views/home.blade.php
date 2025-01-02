<x-layouts.app>
    @if ($initialState && $stepName)
        <livewire:reservation-wizard show-step="{{$stepName}}" :initial-state="$initialState"/>
    @else
        <livewire:reservation-wizard />
    @endif
</x-layouts.app>