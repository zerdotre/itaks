<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

    protected $fillable = ['name', 'img', 'price_km', 'price_min', 'price_start', 'price_waypoint', 'price_minimum', 'max_people', 'max_luggage', 'max_handluggage', 'max_combined_luggage', 'label_1', 'label_2', 'label_3', 'label_4'];

    use HasFactory;

    public function places()
    {
        return $this->belongsToMany(Place::class);
    }
}