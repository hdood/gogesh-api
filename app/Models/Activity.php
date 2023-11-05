<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\App;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'sub_sector_id',
        'status',
        'code'
    ];
    public function getOffers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function specialities(): HasMany
    {
        return $this->hasMany(Speciality::class);
    }
    /**
     * @return HasMany
     */
    public function commercialActivities(): HasMany
    {
        return $this->hasMany(CommercialActivity::class,);
    }
    public function subSector(): BelongsTo
    {
        return $this->belongsTo(SubSector::class);
    }
    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en : $this->name_ar;
    }
}
