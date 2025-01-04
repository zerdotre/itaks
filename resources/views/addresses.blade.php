<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Adressen') }} </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                        <div class="ml-4 mt-2">
                            <h3 class="text-xl font-bold leading-6 font-medium text-gray-900">Adressen</h3>
                        </div>
                    </div>

                    @if (\Session::has('success'))
                    <div class="rounded-md bg-green-50 my-2 text-sm text-green-700 py-3 px-4 -mb-8">{{ \Session::get('success') }}</div>
                    @endif
                    
                    @if(!$addresses->isEmpty())
                        <div class="-mx-4 mt-10 ring-1 ring-gray-300 sm:-mx-6 md:mx-0 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Type</th>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Adres</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Verwijderen</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($addresses as $address)
                                        @if($address)
                                        <tr>
                                            <td class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm font-medium text-gray-900">
                                                {{($address->type == 'airport' ? 'Vliegveld' : 'Adres')}}
                                            </td>
                                            <td class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm font-medium text-gray-900">
                                                @if($address->type == 'airport')
                                                    {{$address->airport}}
                                                @else
                                                    {{$address->route}} {{$address->street_number}},
                                                    {{$address->postal_code}}, {{$address->locality}}
                                                @endif
                                            </td>
                                            <td class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium">
                                                <form action="{{route('addresses.delete')}}" method="post"> @csrf
                                                    <button type="submit" onclick="return confirm('Weet u het zeker?')" name="address_id" value="{{$address->id}}"
                                                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">
                                                        Verwijderen
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    U heeft nog geen adressen.
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>