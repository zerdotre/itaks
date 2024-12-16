<?php

namespace App\Helpers;

use App\Models\Vehicle;
use NumberFormatter;
use RecursiveArrayIterator, RecursiveIteratorIterator;

class Helper
{
    
    public static function strfmon($int, $currency = 'EUR', $show_currency_symbol = true)
    {
        $currency_symbol = ( $currency == 'EUR' ? '€' : ($currency == 'TRY' ? '₺' : '$') );
        $int = str_pad($int, 3, '0', STR_PAD_LEFT);
        return ($show_currency_symbol ? $currency_symbol.' ':'') . substr_replace($int, ',', -2, 0);
    }
    
    public static function toNumerical($str)
    {
        return (int) preg_replace("/[^0-9]/", "", $str);
    }
    
    /*
    * Accepts geocoding response and returns the address components (with keys by subarray items).
    */
    public static function getComponentsFromResponse($response)
    {
        $response = $response->results[0];
        
        $components = [
            'place_id' => $response->place_id,
            'type' => $response->types[0],
            'lat' => $response->geometry->location->lat,
            'lng' => $response->geometry->location->lng,
            ];

            foreach($response->address_components as $comp){
                $components[$comp->types[0]] = $comp->long_name;
            }

            return $components;
    }

    /*
    * Accepts directions response and calculates cumulative distance & duration of legs between origin-waypoints-destination.
    */
    public static function computeTotalDistance($response)
    {
        $legs = $response->routes[0]->legs;

        $total_distance = 0;
        $total_duration = 0;

        foreach($legs as $leg){

            $total_distance += $leg->distance->value / 1000; // kilometers
            $total_duration += $leg->duration->value / 60; // minutes

        }

        return compact('total_distance', 'total_duration');
    }
    
    // round($int/100,2);
    public static function intfflo( $int )
    {
       return round($int/100, 2);
    }

    // distance in km, duration in min
    public static function computePriceForVehicle(Vehicle $vehicle, $distance, $duration)
    {   
        $price_start    = self::intfflo($vehicle->price_start);
        $price_km       = self::intfflo($distance * $vehicle->price_km);
        $price_min      = self::intfflo($duration * $vehicle->price_min);
        
        $subtotal = $price_start + $price_km + $price_min;

        return compact('price_start', 'price_km', 'price_min', 'subtotal');

    }

    public static function flatten_array_preserve_keys(array $array): array {
        $recursiveArrayIterator = new RecursiveArrayIterator(
            $array,
            RecursiveArrayIterator::CHILD_ARRAYS_ONLY
        );
        $iterator = new RecursiveIteratorIterator($recursiveArrayIterator);
    
        return iterator_to_array($iterator);
    }

}