<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Resources\Json\JsonResource;
use Rinvex\Bookings\Traits\HasBookings;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\InteractsWithMedia;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use InteractsWithMedia;
    use HasFactory;
    use HasBookings;
    use HasRoles;


    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'second_name',
        'gender',
        'phone'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function getBookingModel(): string
    {
        // TODO: Implement getBookingModel() method.
    }

    public function userRoles(): array
    {
        return $this->roles->transform(function (\Spatie\Permission\Models\Role $role) {
            return $role;
        })->pluck('name', 'id')->toArray();
    }

    public function userPermissions(): array
    {
        return $this->getAllPermissions()->transform(function (\Spatie\Permission\Models\Permission $permission) {
            return $permission;
        })->pluck('name', 'id')->toArray();
    }

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
