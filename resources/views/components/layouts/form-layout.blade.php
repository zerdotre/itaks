{{-- form navigation --}}
@if (env('APP_ENV') != 'production') @include('livewire.reservation-wizard.navigation') @endif

{{ $slot }}