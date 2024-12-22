<div>
    
    {{-- navigation --}}
    @if (env('APP_ENV') != 'production') @include('livewire.reservation-wizard.navigation') @endif

    <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg">
        <div class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700 px-4 py-5 sm:px-6 rounded-t-lg">
            <h1 class="text-xl font-bold leading-5 text-zinc-900 dark:text-zinc-100">Boek eenvoudig je taxirit</h1>
        </div>

        <form wire:submit="submit(Object.fromEntries(new FormData($event.target)))">
            <div class="py-6 px-4 md:px-6">
                <div>
                    @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-4 mb-5">
                        <div class="flex">
                            <div class="flex-shrink-0"><svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" /></svg></div>
                            <div class="ml-3"><h3 class="text-sm font-medium text-red-800">Oeps! Er bevinden zich fouten in het formulier.</h3></div>
                        </div>
                    </div>
                    @endif
                </div>
            
                <div>
                    <ul role="list" class="block">
                        
                        @foreach ($waypoints as $key => $waypoint)
                        
                        {{-- This is commented out for some customers, because waypoints bring headaches. --}}
                        {{--
                        @if ($loop->last)
                        <!-- add waypoint button -->
                        <li wire:key="add-waypoint-item">
                            <div class="relative pb-8" wire:click="addWaypoint">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-zinc-200" aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <span class="h-8 w-8 rounded-full bg-zinc-400 flex items-center justify-center ring-8 ring-white">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" /></svg>
                                    </span>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1">
                                        <p class="text-sm text-zinc-900 hover:underline cursor-pointer">Tussenstop toevoegen</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endif
                        --}}
                        
                        <li wire:key="waypoint-item-{{$key}}">
                            <div class="relative {{$loop->last ? 'pb-2' : ($addresses ? 'pb-4' : 'pb-8' )}}">
                                @if (!$loop->last) <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-zinc-200" aria-hidden="true"></span> @endif
                                <div class="relative flex space-x-3">
                                    <span class="h-8 w-8 rounded-full bg-zinc-400 flex items-center justify-center ring-8 ring-white">{!!$waypoint['icon']!!}</span>
                                    
                                    <div class="w-full {{-- {{empty($waypoint['value']) ? '' : 'filled'}} --}}">
                                        <!-- Filled: "bg-zinc-50 border-zinc-200 z-10", Not Checked: "border-zinc-200" -->
                                        <div class="flex rounded-md">
                                            
                                            {{-- <input type="text" name="{{$waypoint['name']}}" data-key="{{$key}}" wire:model="waypoints.{{$key}}.value" 
                                            class="autocomplete-input block w-full bg-green-600 flex-1 rounded-none border-0 py-1.5 text-zinc-900 ring-1 ring-inset text-zinc-200 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-600 sm:text-sm sm:leading-6
                                            {{$loop->first || $loop->last ? 'rounded-r-md':''}}"> --}}

                                            <flux:input.group>
                                                <flux:input.group.prefix class="w-16">{{ $waypoint['label'] }}</flux:input.group.prefix>

                                                <flux:input type="text" name="{{$waypoint['name']}}" data-key="{{$key}}" wire:model="waypoints.{{$key}}.value" class:input="autocomplete-input" />
                                            </flux:input.group>
                                            
                                            @if(!$loop->last && $key!=0)
                                                <span wire:click="removeWaypoint({{$key}})"
                                                class="inline-flex items-center border border-l-0 rounded-r-md border-zinc-300 px-3 text-zinc-500 sm:text-sm cursor-pointer">
                                                x
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @auth @if($this->addresses)
                                    <a class="text-sm text-zinc-600 ml-14 font-medium -mb-14 cursor-pointer" wire:click="setWaypointCurrentlyEditing({{$key}})">
                                        Kies uit uw adressen
                                    </a>

                                    @if($showChooseAddressModal && $key==$waypoint_currently_editing)
                                    <div class="bg-white sm:rounded-lg ml-14">
                                        <div class="px-4 py-5 sm:p-6">
                                            <div class="mt-2 max-w-xl text-sm text-zinc-500">
                                                <select wire:model.change="chosenAddressId" class="mt-1 block w-full rounded-md border-zinc-300 py-2 pl-3 pr-10 text-base focus:border-zinc-200 focus:outline-none focus:ring-zinc-200 sm:text-sm">
                                                    <option></option>
                                                    @foreach ($addresses as $address)
                                                        <option value="{{$address->id}}">{{$address->type=='airport' ? $address->locality : $address->route .' '.$address->street_number}}</option>
                                                    @endforeach    
                                                </select>
                                            </div>
                                            <div class="mt-5">
                                                <button type="button" wire:click="$set('showChooseAddressModal', false)" class="text-zinc-500 bg-white hover:bg-zinc-100 focus:ring-4 focus:outline-none focus:ring-zinc-300 rounded-lg border border-zinc-200 text-sm font-medium px-5 py-2.5 hover:text-zinc-900 focus:z-10 dark:bg-zinc-700 dark:text-zinc-300 dark:border-zinc-500 dark:hover:text-white dark:hover:bg-zinc-600 dark:focus:ring-zinc-600">Annuleren</button>
                                                <button type="button" wire:click="chooseAddress()" class="text-white bg-zinc-700 hover:bg-zinc-800 focus:ring-4 focus:outline-none focus:ring-zinc-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-zinc-600 dark:hover:bg-zinc-700 dark:focus:ring-zinc-800">Kiezen</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @endif @endauth
                                    
                                    @error($waypoint['name'])
                                    <div class="rounded-md bg-red-50 my-2 text-sm text-red-700 py-3 px-4"><span class="error">{{ $message }}</span></div>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        @endforeach 
                    </ul>
                    
                    <div class="max-w-2xl mt-6">
                        
                        <flux:input type="datetime-local" wire:model="datetime" min="{{ now()->format('Y-m-d') }}" label="Wanneer wilt u worden opgehaald?" icon="calendar" />
                            
                        @if($origin_is_airport)
                            
                            <flux:input type="text" placeholder="Vluchtnummer" wire:model="flightnr" maxlength="10" class="mt-4" />
                        
                        @endif

                    
                        <div class="mt-6 mb-2"> <flux:checkbox wire:model.live="retour" label="Retour" /> </div>

                        @if($retour)
                        
                            <flux:input type="datetime-local" wire:model="retour_datetime" min="{{ now()->format('Y-m-d\TH:m') }}" label="Retour datum & tijd" icon="calendar" />
                            
                            @if($destination_is_airport)
                                <flux:input type="text" placeholder="Vluchtnummer" wire:model="retour_flightnr" maxlength="10" class="mt-4" />
                            @endif
                            
                        @endif

                    </div>
                    
                </div>
                
            </div>
            
            @include('livewire.reservation-wizard.footer', ['button_text' => 'Bereken mijn ritprijs'])
        </form>
    </div>


@section('scripts')
<script>
    
    var autocomplete = [];
    var options = { language: 'nl', types: ['establishment', 'geocode'], componentRestrictions: {country: ['nl', 'be']} };
    
    window.initMapsAutocomplete = function() { loopAllWaypointElements(); }
    
    function loopAllWaypointElements(){
        
        document.querySelectorAll('.autocomplete-input').forEach(function(element, index, arr) {
            initAutocompleteForElement(element, index);
        });
        
    }
    
    function initAutocompleteForElement(element, index){

        autocomplete[index] = new google.maps.places.Autocomplete(element, options);

        google.maps.event.addListener(autocomplete[index], 'place_changed', function() {
            
            if(this.getPlace().formatted_address){
                var address = this.getPlace().formatted_address;
            }else{
                var address = this.getPlace().name;
            }

            Livewire.dispatch('waypoint-updated', { key:element.dataset.key, address:address });
            
        });

        element.addEventListener('keydown', function(e){ 

            if (e.keyCode == 13 && $('.pac-container:visible').length) {

                e.preventDefault();

                Livewire.dispatch('waypoint-updated', { key:element.dataset.key, address:address });

            }

        });
        
    }
    
    // window.Livewire.on('waypointAdded', () => { loopAllWaypointElements(); });
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (message, component) => { loopAllWaypointElements(); })
    });
    
    $(function(){
        
        loadMaps('initMapsAutocomplete');
        
        // $('.autocomplete-input').keydown(function(e){ if(e.which == 13) return false; }); // to prevent <form> submission
            
        });
    </script>
    @endsection
    
    
    
    
    @section('styles')
    <style>
        .pac-container {
            background-color: #fff;
            position: absolute!important;
            z-index: 1000;
            /* box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3); */
            box-shadow:none;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            overflow: hidden;
            padding:0!important;
            border-radius: 10px;
            border:1px solid rgb(228, 228, 231);
            margin-top:4px;
        }
        .pac-container:after {
            background-image: none !important;
            height: 0px;
            margin:0;padding:0;
        }
        .pac-item {
            display:block;
            cursor: default;
            padding:12px!important;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            line-height: 30px;
            text-align: left;
            font-size: 11px;
            color: #999;
            border:none;
            border-top:1px solid #ccc;
        }
        .pac-item:first-child { border:none; }
        .pac-item:hover,
        .pac-item-selected,
        .pac-item-selected:hover{
            background-color: #4F46E5;
        }
        
        
        .pac-item:hover .pac-item-query, .pac-item:hover .pac-item-query + span,
        .pac-item-selected .pac-item-query, .pac-item-selected .pac-item-query + span,
        .pac-item-selected:hover .pac-item-query, .pac-item-selected:hover .pac-item-query + span
        {
            color:#FFF;
        }
        
        .pac-item-query {
            margin:0!important;
            padding:0!important;
            font-size: 13px;
            display:block;
            color: #5c5b5b;
            font-weight:800;
            font-size:15px;
            height:22px;
        }
        .pac-item-query + span{
            margin:0!important;
            padding:0!important;
            color:#5c5b5b;
            font-size:14px;
        }
        .pac-icon { display:none; }
        .pac-icon-search { background-position: -1px -1px }
        .pac-item-selected .pac-icon-search { background-position: -18px -1px }
        .pac-icon-marker { background-position: -1px -161px }
        .pac-item-selected .pac-icon-marker { background-position: -18px -161px }
        .pac-placeholder { color: zinc }
        
        .filled span, .filled input{background:red!important}


        /* Date & time inputs for makeing the whole input clickable for datetime selection */
        input[type="datetime-local"],
        input[type="date"],
        input[type="time"]{
            position:relative;
        }

        input[type="datetime-local"]::-webkit-calendar-picker-indicator,
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            background: transparent;
            cursor: pointer;
            height: 32px;
            width:100%;
            position: absolute;
            left: 0;
        }
    </style>
    @endsection
</div>