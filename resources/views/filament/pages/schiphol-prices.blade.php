<x-filament::page>
<div class="filament-tables-component">
    <div class="border border-gray-300 shadow-sm bg-white rounded-xl filament-tables-container">
        <div class="filament-tables-table-container overflow-x-auto relative rounded-t-xl">
            <table class="filament-tables-table w-full text-start divide-y table-auto">
                <thead>
                    <tr class="bg-gray-500/5">
                        <th class="w-4 px-4 text-left">Place</th>
                        @foreach($vehicles as $vehicle)
                            <th class="filament-tables-cell w-4 px-4 whitespace-nowrap"
                            data-vehicle-id="{{$vehicle->id}}">
                                {{$vehicle->name}}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                
                <tbody class="divide-y whitespace-nowrap">

                    {{-- {{dd($places[0])}} --}}
                        @foreach($places as $place)
                            <tr class="filament-tables-row transition hover:bg-gray-50">
                                <td class="filament-tables-cell w-4 px-4 whitespace-nowrap">{{$place->name}}</td>
                                @foreach($vehicles as $key => $vehicle)
                                <td class="filament-tables-cell w-4 px-4 whitespace-nowrap">
                                    {{Helper::strfmon($place->vehicles[$key]->pivot->price ?? '')}}
                                    
                                    <button class="border py-1 px-2 rounded-full"
                                    wire:click="$dispatch('openModal', {
                                    component: 'place-vehicle-price-modal',
                                    arguments: {
                                        place_id: {{$place->id ?? ''}},
                                        vehicle_id: {{$vehicle->id ?? ''}}
                                    }
                                    })">
                                        <x-heroicon-o-pencil class="w-5 h-5 text-gray-500 inline"/>
                                    </button>

                                </td>
                                @endforeach
                            </tr>
                        @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-filament::page>