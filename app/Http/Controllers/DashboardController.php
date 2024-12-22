<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('dashboard', compact('reservations'));
    }

    public function addresses()
    {
        $addresses = auth()->user()->addresses;

        return view('addresses', compact('addresses'));
    }

    public function destroyAddress(Request $request)
    {
        $addresses = auth()->user()->addresses;
        $address_ids = $addresses->pluck('id')->toArray();
        $address_is_of_user = in_array($request->address_id, $address_ids);

        if($address_is_of_user){
    
            $address = Address::where('id', $request->address_id)->first()->delete();
            return redirect()->route('addresses')->with('success', 'Adres succesvol verwijderd');

        }

        return redirect()->route('addresses');
    }

}