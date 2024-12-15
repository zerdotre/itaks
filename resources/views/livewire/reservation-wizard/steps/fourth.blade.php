<div>
@include('livewire.reservation-wizard.navigation')
<form class="flow-root overflow-hidden bg-white shadow rounded-lg" wire:submit="submit">
    
    <div class="px-4 py-5 sm:p-6">
        <div class="md:grid md:grid-cols-2 md:gap-6">
            <div>
                
                <div class="overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Reisgegevens</h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="px-4 border-b border-gray-200 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Prijs</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 font-bold">
                                    {{ Helper::strfmon( $prices[$vehicle_id]['total'] ) }}
                                </dd>
                            </div>
                            <div class="px-4 border-b border-gray-200 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Voertuig</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 font-bold">{{$vehicle_name}}</dd>
                            </div>
                            <div class="px-4 border-b border-gray-200 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Ophaalmoment</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 font-bold">{{\Carbon\Carbon::parse($reservation_data['datetime'])->format('d.m.Y H:i')}}</dd>
                            </div>
                            @if(!empty($reservation_data['flightnr']))
                            <div class="border-b border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Vluchtnummer</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $reservation_data['flightnr'] }}</dd>
                            </div>
                            @endif
                            @if($reservation_data['retour'])
                            <div class="border-b border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Retour ophaalmoment</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 font-bold">{{\Carbon\Carbon::parse($reservation_data['retour_datetime'])->format('d.m.Y H:i')}}</dd>
                            </div>
                            
                            @if(!empty($reservation_data['retour_flightnr']))
                            <div class="border-b border-gray-200 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Vluchtnummer</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $reservation_data['retour_flightnr'] }}</dd>
                            </div>
                            @endif
                            
                            @endif
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Reis</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    <ul role="list" class="-mb-6">
                                        @foreach ($waypoint_data as $wpitem)
                                        <li>
                                            <div class="relative pb-6">
                                                @if(!$loop->last) <span class="absolute top-3 left-3 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span> @endif
                                                <div class="relative flex space-x-3">
                                                    <div>
                                                        <span class="h-6 w-6 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                            @if ($loop->last)
                                                            <span class="h-6 w-6 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                                <svg class="h-5 w-5 text-white" x-description="Heroicon name: mini/check" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"></path>
                                                                </svg>
                                                            </span>
                                                            @else
                                                            <span class="h-6 w-6 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                                                </svg>          
                                                            </span>
                                                            @endif
                                                            
                                                        </span>
                                                    </div>
                                                    <div class="flex min-w-0 flex-1 justify-between space-x-4">
                                                        <div>
                                                            <p class="text-sm font-bold text-sky-700">
                                                                @if( $wpitem['type'] == 'premise' || $wpitem['type'] == 'route' || $wpitem['type'] == 'street_address') {{$wpitem['route']}} {{$wpitem['street_number'] ?? ''}}
                                                                @else {{$wpitem['airport'] ?? ''}}
                                                                @endif
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                {{$wpitem['postal_code']}} {{$wpitem['locality']}} 
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="mt-5 space-y-4 md:mt-0">
                    <div>
                        <label for="name" class="block text-sm font-medium text-sky-700">Naam</label>
                        <div class="mt-1">
                            <input type="text" wire:model.blur="name" class="block w-full flex-1 rounded-md border-gray-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                            @error($name)
                            <div class="rounded-md bg-red-50 my-2 text-sm text-red-700 py-3 px-4"><span class="error">{{ $errors->first('name') }}</span></div>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-sky-700">Telefoonnummer</label>
                        <div class="mt-1">
                            <input type="tel" wire:model.blur="phone" class="block w-full flex-1 rounded-md border-gray-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                            @error($phone)
                            <div class="rounded-md bg-red-50 my-2 text-sm text-red-700 py-3 px-4"><span class="error">{{ $errors->first('phone') }}</span></div>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-sky-700">E-mailadres</label>
                        <div class="mt-1">
                            <input type="email" wire:model.blur="email" class="block w-full flex-1 rounded-md border-gray-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                            @error($email)
                            <div class="rounded-md bg-red-50 my-2 text-sm text-red-700 py-3 px-4"><span class="error">{{ $errors->first('email') }}</span></div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="comments" class="block text-sm font-medium text-sky-700">Opmerkingen <span class="text-sm text-gray-400 ml-1">optioneel</span></label>
                        <div class="mt-1">
                            <textarea wire:model.blur="comments" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm"></textarea>
                        </div>
                    </div>
                    
                    {{-- <div>
                        <label for="password" class="block text-sm font-medium text-sky-700">Maak een wachtwoord aan <span class="text-sm text-gray-400 ml-1">optioneel</span></label>
                        <div class="mt-1">
                            <input type="password" wire:model="password" class="block w-full flex-1 rounded-md border-gray-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                        </div>
                    </div> --}}
                    
                </div>
            </div>
        </div>
        
        
        {{-- Footer --}}
        @include('livewire.reservation-wizard.footer', ['button_text' => 'Reserveren'])

    </div>
</form>
</div>