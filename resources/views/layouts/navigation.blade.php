<nav x-data="{ open: false }" class="text-white bg-sky-800">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-3xl px-4 flex h-16 justify-between">

        <div class="flex items-center">
            <a href="{{ config('app.url') }}" class="font-bold text-2xl">
                {{ config('app.name') }}
            </a>
        </div>

        <div class="flex">
            
            <!-- Desktop Dropdown -->
            <div class="flex items-center sm:ml-6">
                <x-testdropdown align="right" width="48">
                    
                    <x-slot name="trigger">
                        
                        <button class="inline-flex items-center p-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @auth <div>{{ Auth::user()->name ?? '' }}</div> @endauth
                            @guest
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>                                  
                            @endguest
                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('welcome')">{{ __('Reserveren') }}</x-dropdown-link>


                        @auth
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profiel') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('dashboard')">{{ __('Reserveringen') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('addresses')">{{ __('Adressen') }}</x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}"> @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Uitloggen') }}
                            </x-dropdown-link>
                        </form>
                        @endauth

                        @guest
                        <x-dropdown-link :href="route('login')">{{ __('Inloggen') }}</x-dropdown-link>
                        @endguest


                    </x-slot>
                </x-testdropdown>
            </div>

        </div>

    </div>



    
    {{-- <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white">

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @auth    
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name ?? '' }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email ?? '' }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                @auth
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profiel') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('dashboard')">{{ __('Reserveringen') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('addresses')">{{ __('Adressen') }}</x-responsive-nav-link>
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Uitloggen') }}
                        </x-responsive-nav-link>
                    </form>
                @endauth
                
                @guest
                    <x-responsive-nav-link :href="route('login')">{{ __('Inloggen') }}</x-responsive-nav-link>    
                @endguest
            </div>
        </div>
    </div> --}}
</nav>