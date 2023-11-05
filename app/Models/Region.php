<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Region extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'city_id',
        'status',
    ];
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'region_id');
    }

    public function sellers(): HasMany
    {
        return $this->hasMany(Seller::class, 'region_id');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en : $this->name_ar;
    }
}
