<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\App;

/**
 * @property mixed $name_en
 * @property mixed $name_ar
 */
class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'status',
    ];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
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
