<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Testing\Fluent\Concerns\Has;
use Rinvex\Bookings\Traits\Bookable;

class Room extends Model
{

    protected $fillable = [
        'room_name',
        'room_number',
        'about_room',
        'price_per_night',
        'photo'
    ];

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
