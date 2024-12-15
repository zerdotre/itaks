<div>
@include('livewire.reservation-wizard.navigation')
<div class="flow-root">
    <form class="overflow-hidden bg-white shadow rounded-lg" wire:submit="submit">
        
        <div class="bg-white px-4 py-5 grid grid-cols-2 gap-4">

            <div class="bg-white shadow-sm border p-4 rounded-lg">
                <h2 class="text-lg font-medium leading-5 text-sky-600 mb-4">Aantal personen</h2>
                <select wire:model="people"
                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm">
                    @foreach ($people_count as $i)
                        <option value="{{$i}}">{{$i}}</option>
                    @endforeach    
                </select>
            </div>

            <div></div>

            <div class="bg-white shadow-sm border p-4 rounded-lg">
                <h2 class="text-xl font-medium leading-5 text-sky-600 mb-4">Aantal koffers</h2>
                <select wire:model="luggage"
                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm">
                    @foreach ($luggage_count as $i)
                        <option value="{{$i}}">{{$i}}</option>
                    @endforeach    
                </select>
            </div>
            <div class="bg-white shadow-sm border p-4 rounded-lg">
                <h2 class="text-xl font-medium leading-5 text-sky-600 mb-4">Handbagage</h2>
                <select wire:model="handluggage"
                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm">
                    @foreach ($handluggage_count as $i)
                        <option value="{{$i}}">{{$i}}</option>
                    @endforeach    
                </select>
            </div>
        </div>

        @include('livewire.reservation-wizard.footer', ['button_text' => 'Bereken mijn ritprijs'])

    </form>
</div>
</div>