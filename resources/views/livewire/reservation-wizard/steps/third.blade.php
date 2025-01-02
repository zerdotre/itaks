<zerre> @include('livewire.reservation-wizard.navigation')
<div class="border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden">
    <form wire:submit="submit">
        <div class="bg-white px-4 py-5">
            <div class="space-y-4">

                @foreach ($vehicles as $vehicle)
                <div>
                    <input type="radio" wire:model="chosen_vehicle" value="{{$vehicle->id}}" class="sr-only peer" id="vehicle_{{$vehicle->id}}" aria-labelledby="{{$vehicle->name}}" aria-describedby="{{$vehicle->name}}">
                    <label for="vehicle_{{$vehicle->id}}"
                    class="relative block cursor-pointer rounded-lg border bg-white px-6 py-4 shadow-sm focus:outline-none hover:shadow-lg hover:bg-sky-100
                    peer-checked:ring-sky-500 peer-checked:ring-2
                    grid grid-cols-2
                    ">
                        <span class="flex flex-col md:flex-row-reverse">
                            
                            <div class="flex flex-col text-sm w-full">
                                <div class="text-lg font-bold text-sky-700 mb-4 md:mb-0">{{$vehicle->name}}</div>
                                
                                <div class="hidden sm:flex flex-col">
                                    @for ($i=1; $i<5; $i++)
                                        <span class="text-gray-500">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 block sm:inline text-green-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                            <span class="block sm:inline">{!!$vehicle->{'label_'.$i}!!}</span>
                                        </span>
                                    @endfor
                                </div>
                            </div>

                            <div class="md:mr-10 max-w-80 flex items-center">
                                <img src="{{asset('img/'.strtolower($vehicle->name).'_small.webp')}}" alt="{{$vehicle->name}} icon">
                            </div>

                        </span>

                        <span class="text-right flex flex-col justify-between">
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-sky-700">
                                    {{ Helper::strfmon($prices[$vehicle->id]['total']) }}
                                </span>
                                <span class="text-gray-500 text-sm">Enkele rit</span>
                            </div>
                            <span class="font-medium text-gray-900">
                                <button type="submit"
                                class="py-2 px-6 text-white font-semibold border border-sky-700 rounded shadow-4xl focus:ring focus:ring-sky-300 bg-sky-600 hover:bg-sky-700 transition ease-in-out duration-200">
                                    Selecteer
                                </button>
                            </span>
                        </span>
                    </label>
                </div>
                @endforeach

                <hr>

                <div class="bg-white shadow-sm p-4 rounded-lg border">
                    <h2 class="text-lg font-bold leading-5 text-sky-600 mb-4">Betaalmethode</h2>
                    <select wire:model="payment_method"
                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm">
                        @foreach ($payment_methods as $payment_method)
                            <option value="{{$payment_method}}">{{$payment_method}}</option>
                        @endforeach    
                    </select>
                </div>

            </div>
        </div>


        {{-- Footer --}}
        @include('livewire.reservation-wizard.footer', ['button_text' => 'Bereken mijn ritprijs'])

    </form>
</div>
</zerre>