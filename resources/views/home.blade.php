<x-app-layout>
    @if ($initialState && $stepName)
        <livewire:reservation-wizard show-step="{{$stepName}}" :initial-state="$initialState"/>
    @else
        <livewire:reservation-wizard />
    @endif
</x-app-layout>