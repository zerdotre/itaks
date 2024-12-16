<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id', 'type', 'lat', 'lng', 'route', 'street_number',
        'postal_code', 'locality', 'administrative_area_level_2',
        'country',
        'airport'
    ];

    public function origin(){return $this->BelongsTo(Reservation::class);}
    public function destination(){return $this->BelongsTo(Reservation::class);}

    /**
     * The reservation this waypoint (address) belongs to.
     */
    public function reservation(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function(Address $address) {
            
            if(auth()->check()) $address->user_id = auth()->user()->id;

        });

        static::updating(function(Address $address) {
            
            if(auth()->check()) $address->user_id = auth()->user()->id;

        });
    }
}
