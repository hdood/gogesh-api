<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'country_id',
        'status',
    ];
    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en : $this->name_ar;
    }

    public function sellers(): HasMany
    {
        return $this->hasMany(Seller::class);
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
