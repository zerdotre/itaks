<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700 py-3">

    <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="{{ config('app.name') }}" class="dark:hidden" />
    <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="{{ config('app.name') }}" class="hidden dark:flex" />

    <flux:spacer />

    <flux:dropdown>
        <flux:button icon-trailing="chevron-down">{{ Auth::user()->name ?? 'Inloggen' }}</flux:button>

        <flux:menu>
            <flux:navmenu.item icon="plus" href="{{route('home')}}">Nieuwe Reservering</flux:navmenu.item>
            <flux:menu.separator />

            @guest <flux:navmenu.item href="{{route('login')}}">Inloggen</flux:navmenu.item> @endguest
            @auth
                <flux:navmenu.item href="{{ route('profile') }}">{{ __('Profiel') }}</flux:navmenu.item>
                <flux:navmenu.item href="{{ route('dashboard') }}">{{ __('Reserveringen') }}</flux:navmenu.item>
                <flux:navmenu.item href="{{ route('addresses') }}">{{ __('Adressen') }}</flux:navmenu.item>
                    <flux:navmenu.item icon="arrow-right-start-on-rectangle" wire:click="logout">Uitloggen</flux:navmenu.item>
            @endauth

        </flux:menu>
    </flux:dropdown>
</flux:header>