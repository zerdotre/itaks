<div>
    
    @if (env('APP_ENV') != 'production') @include('livewire.reservation-wizard.navigation') @endif
    
    <form class="bg-white shadow rounded-lg" wire:submit="submit(Object.fromEntries(new FormData($event.target)))">
    
        <!-- Head -->
        <div class="bg-gradient-to-r from-sky-800 to-sky-900 border-b border-gray-200 px-4 py-5 sm:px-6 rounded-t-lg">
            <h1 class="text-xl font-bold leading-5 text-white">Boek eenvoudig je taxirit</h1>
        </div>
        
        <!-- Content -->
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
            
            <div class="{{-- md:grid grid-cols-2 --}} md:divide-x">
                <div>
                    <ul role="list" class="block">
                        
                        @foreach ($waypoints as $key => $waypoint)
                        
                        {{-- This is commented out for some customers, because waypoints bring headaches. --}}
                        {{--
                        @if ($loop->last)
                        <!-- add waypoint button -->
                        <li wire:key="add-waypoint-item">
                            <div class="relative pb-8" wire:click="addWaypoint">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" /></svg>
                                    </span>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1">
                                        <p class="text-sm text-gray-900 hover:underline cursor-pointer">Tussenstop toevoegen</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endif
                        --}}
                        
                        <li wire:key="waypoint-item-{{$key}}">
                            <div class="relative {{$loop->last ? 'pb-2' : ($addresses ? 'pb-4' : 'pb-8' )}}">
                                @if (!$loop->last) <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span> @endif
                                <div class="relative flex space-x-3">
                                    <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">{!!$waypoint['icon']!!}</span>
                                    
                                    <div class="w-full {{-- {{empty($waypoint['value']) ? '' : 'filled'}} --}}">
                                        <!-- Filled: "bg-sky-50 border-sky-200 z-10", Not Checked: "border-gray-200" -->
                                        <div class="flex rounded-md shadow-sm">
                                            <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 justify-center text-sky-600 font-bold sm:text-sm w-12">{{$waypoint['label']}}</span>
                                            
                                            <input type="text" name="{{$waypoint['name']}}" data-key="{{$key}}" wire:model="waypoints.{{$key}}.value"
                                            class="autocomplete-input block w-full flex-1 rounded-none border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6
                                            {{$loop->first || $loop->last ? 'rounded-r-md':''}}">
                                            
                                            @if(!$loop->last && $key!=0)
                                                <span wire:click="removeWaypoint({{$key}})"
                                                class="inline-flex items-center border border-l-0 rounded-r-md border-gray-300 px-3 text-gray-500 sm:text-sm cursor-pointer">
                                                x
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @auth @if($this->addresses)
                                    <a class="text-sm text-sky-700 ml-14 font-medium -mb-14 cursor-pointer" wire:click="setWaypointCurrentlyEditing({{$key}})">
                                        Kies uit uw adressen
                                    </a>

                                    @if($showChooseAddressModal && $key==$waypoint_currently_editing)
                                    <div class="bg-white shadow sm:rounded-lg ml-14">
                                        <div class="px-4 py-5 sm:p-6">
                                            <div class="mt-2 max-w-xl text-sm text-gray-500">
                                                <select wire:model.change="chosenAddressId" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm">
                                                    <option></option>
                                                    @foreach ($addresses as $address)
                                                        <option value="{{$address->id}}">{{$address->type=='airport' ? $address->locality : $address->route .' '.$address->street_number}}</option>
                                                    @endforeach    
                                                </select>
                                            </div>
                                            <div class="mt-5">
                                                <button type="button" wire:click="$set('showChooseAddressModal', false)" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Annuleren</button>
                                                <button type="button" wire:click="chooseAddress()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kiezen</button>
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
                
                {{-- horizontal separator
                </div>
                <div class="pt-4 mt-4 pl-0 border-t border-gray-300 md:border-t-0 md:pl-4 md:pt-0 md:mt-0"> --}}
                    
                    <div>
                        <span class="block md:h-6 mt-4">
                            <h2 class="text-sm text-sky-600 font-bold">Wanneer wilt u worden opgehaald?</h2>
                        </span>
                        <div class="md:grid grid-cols-2 gap-4 items-start">
                            
                            <div>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 z-10 text-xs text-gray-600">
                                        Datum
                                        {{-- <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                        </svg> --}}
                                    </div>
                                    
                                    <input type="date" wire:model="date" min="{{ now()->format('Y-m-d') }}"
                                        class="block w-full rounded-md border-0 py-1.5 pl-16 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 z-10 text-xs text-gray-600">
                                        Tijd
                                        {{-- <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg> --}}
                                    </div>
                                    <input type="time" wire:model="time"
                                        class="block w-full rounded-md border-0 py-1.5 pl-16 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div>
                                {{-- If origin is a airport, show flightnr for origin --}}
                                @if($origin_is_airport)
                                    <input type="text" placeholder="Vluchtnummer" wire:model="flightnr" min="{{date("Y-m-d\TH:i:s")}}" maxlength="10"
                                    class="block w-full rounded-md border-gray-300 py-2 text-base focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm mt-4" />
                                @endif
                            </div>

                        </div>
                    </div>
                    
                    @if($destination_is_airport)
                    <div class="mt-6">
                        <div class="relative flex items-start h-6">
                            <div class="flex h-5 items-center"> <input id="retour" value="1" wire:model.live="retour" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500"> </div>
                            <div class="ml-2 text-sm">
                                <label for="comments" class="font-medium text-sky-600">Retour</label>
                            </div>
                        </div>
                        
                        <div class="md:grid grid-cols-2 gap-4">
                            <div>
                                @if($retour)
                                <input
                                    type="datetime-local"
                                    placeholder="Ophaalmoment retour"
                                    wire:model="retour_datetime"
                                    min="{{ now()->format('Y-m-d\TH:m') }}"
                                    class="mb-2 md:m-0
                                    w-full flex-1 border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6 rounded-md "
                                    {{-- display-format="DD.MM.YYYY HH:mm" --}}
                                >
                                @else
                                {{-- For decoration purposes --}}
                                <input type="text" placeholder="Retour" disabled class="block w-full rounded-md border-gray-300 py-2 text-base focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500 mb-2 md:m-0">
                                @endif
                            </div>

                            <div>
                                <input type="text" placeholder="Vluchtnr retour" wire:model="retour_flightnr" maxlength="10"
                                {{$retour ? '' : 'disabled'}}
                                class="block w-full rounded-md border-gray-300 py-2 text-base focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500">
                            </div>
                        </div>

                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
        
        @include('livewire.reservation-wizard.footer', ['button_text' => 'Bereken mijn ritprijs'])

    </form>


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
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            overflow: hidden;
            padding:0!important;
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
        .pac-placeholder { color: gray }
        
        .filled span, .filled input{background:red!important}


        /* Date & time inputs*/

        input[type="date"], input[type="time"]{
            position:relative;
        }
        input[type="date"]::-webkit-calendar-picker-indicator, input[type="time"]::-webkit-calendar-picker-indicator {
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