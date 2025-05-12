<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable; // Make sure you're using this

class User extends Authenticatable  // Extends Authenticatable now
{
    protected $table = 'users';
    public $timestamps = false;

    protected $casts = [
        'last_seen' => 'datetime',
        'zip_code' => 'int',
        'country_id' => 'int'
    ];

    protected $fillable = [
        'username',
        'hash',
        'salt',
        'display_name',
        'first_name',
        'last_name',
        'address',
        'p_p',
        'last_seen',
        'email',
        'phone_number',
        'city',
        'zip_code',
        'country_id'
    ];

    // Other relationships remain unchanged
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function shops()
    {
        return $this->belongsToMany(Shop::class, 'user_shop')
                    ->withPivot('id', 'time_of_acquisition', 'start_date', 'end_date');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // If your password field is 'hash', override this method
    public function getAuthPassword()
    {
        return $this->hash;
    }
}
