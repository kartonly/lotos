<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'user_id',
        'summ',
        'available'
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date'
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(ServicesBookings::class);
    }
}
