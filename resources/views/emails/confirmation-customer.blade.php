<h1 style="text-align:center;color:#f58341;font-size:18px">Bedankt voor uw boeking bij
    <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
</h1><br>
<p style="font-weight:bold;">Uw ontvangt deze email als bevestiging voor uw boeking.</p>
<div style="width:100%;">
    <div style="padding-top:12px;">
        <table style="width:100%;display:block;">
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
                        <td style="min-width:120px">Tussenstop:</td>
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

            <tr><td style="min-width:120px">Ophaalmoment:</td><td>{{ (new DateTime($reservation->datetime))->format('d.m.Y H:i') }}</td></tr>
            @if ($reservation->flightnr)
                <tr><td style="min-width:120px">Vluchtnr:</td><td>{{ $reservation->flightnr }}</td></tr>
            @endif
            <tr><td style="min-width:120px">Vervoer:</td><td>{{ $reservation->vehicle->name }}</td></tr>
            <tr><td style="min-width:120px">Aantal personen:</td><td>{{ $reservation->people }}</td></tr>
            <tr><td style="min-width:120px">Handbagage:</td><td>{{ $reservation->handluggage }}</td></tr>
            <tr><td style="min-width:120px">Koffers:</td><td>{{ $reservation->luggage }}</td></tr>
            <tr><td style="min-width:120px">Betaalmethode:</td><td>{{ $reservation->payment_method }}</td></tr>
            <tr><td style="min-width:120px">Prijs:</td><td>{{ Helper::strfmon($reservation->price) }}</td></tr>
            @if ($reservation->comments)
                <tr><td style="min-width:120px">Opmerkingen:</td><td>{{ $reservation->comments }}</td></tr>
            @endif

            @if ($reservation->retour_id)
                <tr><td colspan="2"> <br><strong>Retour</strong> </td></tr>
                <tr><td style="min-width:120px">Retour ophaalmoment:</td><td>{{ (new DateTime($retour->datetime))->format('d.m.Y H:i') }}</td></tr>
                @if ($retour->flightnr)
                    <tr><td style="min-width:120px">Retour vluchtnr:</td><td>{{ $retour->flightnr }}</td></tr>
                @endif
                <tr><td style="min-width:120px">Prijs:</td><td>{{ Helper::strfmon($reservation->price) }}</td></tr>
            @endif
            <tr>
                <td style="min-width:120px;padding-top:20px;" colspan="2">

                    Vertrek naar Schiphol Airport: <br>
                    •   Zorg ervoor dat u op het gereserveerde tijdstip klaar staat.<br><br>
                    •   Wijzigingen kunnen tot 4 uur voor de reservering telefonisch doorgegeven worden.<br><br>
                    •   Indien de chauffeur langer dan 5 minuten staat te wachten zal er een wachttarief in rekening worden gebracht.<br><br>

                    Ophalen vanaf Schiphol Airport:<br>
                    1) Als u bent geland op Schiphol Airport, voor u de koffers van de band haalt, belt u naar de centrale. <a href="tel:0031854005400">085 400 5 400</a>.<br><br>
                    2) Zodra u de bagage van de band heeft gehaald, loopt u richting vertrekhal 3 (deur C). Daar loopt u naar buiten en steekt u het zebrapad over.<br><br>
                    3) De chauffeur die u komt ophalen neemt d.m.v. telefonisch contact (SMS of bellen) contact met u op. Die zal u het merk, kenteken en kleur van de auto doorgeven.<br><br>
                    <br>
                    @if ($reservation->retour_id)
                    Let op: de gegeven prijs is voor een enkele reis.
                    @endif
                </td>
            </tr>
        </table>

        <p style="width:100%">
            Met vriendelijke groet,<br>
            Team <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
        </p>    
    </div>
</div>