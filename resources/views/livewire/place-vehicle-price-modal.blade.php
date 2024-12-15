<div>
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow rounded-lg sm:px-10">
            <div class="my-6">
                <h2>
                    <x-heroicon-o-chevron-double-right class="w-4 h-4 my-auto text-gray-500 inline"/> {{$place_name}}
                    <x-heroicon-o-chevron-right class="w-4 h-4 my-auto text-gray-500 inline"/> {{$vehicle_name}}
                </h2>
            </div>

            <form class="space-y-6" wire:submit="save">
                <div>
                    <label class="block text-sm font-medium text-gray-700"> {{__('Price')}} </label>
                    <div class="mt-1">
                        <input type="number" required
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm"
                        wire:model="price">
                    </div>
                </div>
                
                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div>
                        <a class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer"
                        wire:click="cancel">
                            X{{-- <x-heroicon-o-x class="w-4 h-4 my-auto text-gray-500 inline"/> --}}
                            {{__('Cancel')}}
                        </a>
                    </div>
                    
                    <div>
                        <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 cursor-pointer">
                            <x-heroicon-o-check class="w-4 h-4 my-auto text-gray-500 inline"/>
                            {{__('Submit')}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>