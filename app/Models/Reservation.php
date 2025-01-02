<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public static $statuses = [
        'new' => 'new',
        'completed' => 'completed',
        'cancelled' => 'cancelled',
    ];


    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->BelongsTo(Vehicle::class);
    }

    public function origin(): BelongsTo
    {
        return $this->BelongsTo(Address::class, 'origin_id');
    }

    public function destination(): BelongsTo
    {
        return $this->BelongsTo(Address::class, 'destination_id');
    }

    public function waypoints()
    {
        return $this->belongsToMany(Address::class);
    }

    public static function generateRandId()
    {
        $rand_id = Str::random(16);
        if (Reservation::where('rand_id', $rand_id)->exists()) {
            return Reservation::generateRandId();
        }else{
            return $rand_id;
        }
    }

    public function setDatetimeAttribute($value)
    {
        $this->attributes['datetime'] = Carbon::parse($value);
    }
}