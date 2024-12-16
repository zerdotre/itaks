<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{

    protected $table = 'default_price_places';
    protected $fillable = ['name', 'type']; //type = [place/zipcode]

    use HasFactory;

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class)->orderBy('id', 'asc')->withPivot('price');
    }
}