<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\App;

class Speciality extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'activity_id',
        'status',
    ];
    public function getOffers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }


    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * @return HasMany
     */
    public function commercialActivities(): HasMany
    {
        return $this->hasMany(CommercialActivity::class, 'specialization_id');
    }

    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en : $this->name_ar;
    }
}
