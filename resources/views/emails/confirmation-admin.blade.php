<div style="width:100%;">
    <div style="padding-top:12px;">
        <table style="width:100%;display:block;">
            <tr><td colspan="2"><strong>Klantgegevens</strong></td></tr>
            <tr><td style="min-width:120px">Naam:</td><td>{{ $reservation->user->name }}</td></tr>
            <tr><td style="min-width:120px">Telefoon:</td><td>{{ $reservation->user->phone }}</td></tr>
            <tr><td style="min-width:120px">Email:</td><td>{{ $reservation->user->email }}</td></tr>
            
            <tr><td colspan="2" style="padding-top:20px"><strong>Reisgegevens</strong></td></tr>
            <tr><td style="min-width:120px">Ophaalmoment:</td><td>{{ (new DateTime($reservation->datetime))->format('d.m.Y H:i') }}</td></tr>
            @if ($reservation->flightnr)
                <tr><td style="min-width:120px">Vluchtnr:</td><td>{{ $reservation->flightnr }}</td></tr>
            @endif
            <tr>
                <td style="min-width:120px">Van:</td>
                <td style="min-width:180px;">
                    {{$reservation->origin->route ?? $reservation->origin->airport}}
                    {{$reservation->origin->street_number ?? ''}},
                    {{$reservation->origin->locality}}
                </td>
            </tr>

            @if(!$reservation->waypoints->isEmpty())
                @foreach ($reservation->waypoints as $waypoint)
                    <tr>
                        <td style="min-width:120px">tussenstop:</td>
                        <td>
                            {{$waypoint->route ?? $waypoint->airport}}
                            {{$waypoint->street_number ?? ''}},
                            {{$waypoint->locality}}
                        </td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td style="min-width:120px">Bestemming:</td>
                <td style="min-width:180px;">
                    {{$reservation->destination->route ?? $reservation->destination->airport}}
                    {{$reservation->destination->street_number ?? ''}},
                    {{$reservation->destination->locality}} 
                </td>
            </tr>

            <tr><td style="min-width:120px">Vervoer:</td><td>{{ $reservation->vehicle->name }}</td></tr>
            <tr><td style="min-width:120px">Aantal personen:</td><td>{{ $reservation->people }}</td></tr>
            <tr><td style="min-width:120px">Handbagage:</td><td>{{ $reservation->handluggage }}</td></tr>
            <tr><td style="min-width:120px">Koffers:</td><td>{{ $reservation->luggage }}</td></tr>
            <tr><td style="min-width:120px">Betaalmethode:</td><td>{{ $reservation->payment_method }}</td></tr>
            @if ($reservation->comments)
                <tr><td style="min-width:120px">Opmerkingen:</td><td>{{ $reservation->comments }}</td></tr>
            @endif

            @if ($reservation->retour_id)
                <tr><td colspan="2"> <br><strong>Retour</strong> </td></tr>
                <tr><td style="min-width:120px">Retour ophaalmoment:</td><td>{{ (new DateTime($retour->datetime))->format('d.m.Y H:i') }}</td></tr>
                @if ($retour->flightnr)
                    <tr><td style="min-width:120px">Retour vluchtnr:</td><td>{{ $retour->flightnr }}</td></tr>
                @endif
            @endif

            <tr><td style="min-width:120px">Afstand:</td><td>{{ ceil($reservation->distance) }} km</td></tr>
            <tr><td style="min-width:120px">Duratie:</td><td>{{ ceil($reservation->duration) }} min.</td></tr>
            <tr><td style="min-width:120px">Prijs:</td><td>{{ Helper::strfmon($reservation->price) }}</td></tr>
        </table>

        <p style="width:100%">
            Met vriendelijke groet,<br>
            Team {{ config('app.name') }}
        </p>    
    </div>
</div>