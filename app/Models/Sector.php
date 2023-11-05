<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Sector extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'icon',
        'status',
    ];
    public function getOffers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class,);
    }

    /**
     * @return HasMany
     */
    public function commercialActivities(): HasMany
    {
        return $this->hasMany(CommercialActivity::class, 'sector_id');
    }

    public function sellers(): HasMany
    {
        return $this->hasMany(Seller::class, 'sector_id');
    }

    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en : $this->name_ar;
    }
}
