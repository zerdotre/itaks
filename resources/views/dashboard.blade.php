<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Reserveringen') }} </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                        <div class="ml-4 mt-2">
                            <h3 class="text-xl font-bold leading-6 font-medium text-gray-900">Reserveringen</h3>
                        </div>
                        <div class="ml-4 mt-2 flex-shrink-0">
                            <a href="{{route('welcome')}}" class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                Nieuwe Reservering
                            </a>
                        </div>
                    </div>
                    @if(!$reservations->isEmpty())
                        <div class="-mx-4 mt-10 ring-1 ring-gray-300 sm:-mx-6 md:mx-0 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Ophaalmoment</th>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Van</th>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Naar</th>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Prijs</th>
                                        {{-- <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Annuleren</span></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                            <td class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm font-medium text-gray-900">
                                                <div class="">{{(new DateTime($reservation->datetime))->format('d.m.Y H:i')}}</div>
                                            </td>
                                            <td class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm font-medium text-gray-900">
                                                @if($reservation->origin)
                                                    {{$reservation->origin->airport ?? $reservation->origin->route}}
                                                    {{$reservation->origin->street_number ?? ''}},
                                                    {{$reservation->origin->locality}}
                                                @endif
                                            </td>
                                            <td class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm font-medium text-gray-900">
                                                @if($reservation->destination)
                                                    {{$reservation->destination->airport ?? $reservation->destination->route}}
                                                    {{$reservation->destination->street_number ?? ''}},
                                                    {{$reservation->destination->locality}}
                                                @endif
                                            </td>
                                            <td class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm font-medium text-gray-900">
                                                {{Helper::strfmon($reservation->price)}}
                                            </td>
                                            {{-- <td class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium">
                                                {{$reservation->status == 'cancelled' ? 'Geannuleerd' : ''}}
                                                @if($reservation->status != 'cancelled' && strtotime($reservation->datetime) > time())
                                                <a href="{{route('cancelled', [$reservation->rand_id])}}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">
                                                    Annuleren
                                                </a>
                                                @endif
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    U heeft nog geen reservaties.
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>