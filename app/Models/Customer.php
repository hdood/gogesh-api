<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $hidden = array('password');


    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'gender',
        'status',
        'country_id',
        'city_id',
        'region_id',
        'country',
        'city',
        'region',
        'password',
        'image',
        'completed',
        'fcm_token'
    ];
    /**
     * Get the user that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function requestedOffer(): HasMany
    {
        return $this->hasMany(Order::class,);
    }

    public function favourites()
    {
        return $this->belongsToMany(Offer::class, 'favorites', 'customer_id', 'offer_id');
    }
}
