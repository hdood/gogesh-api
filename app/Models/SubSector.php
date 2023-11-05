<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class SubSector extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'sector_id',
        'status',
    ];

    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en ?? null : $this->name_ar ?? null;
    }
    public function commercialActivities(): HasMany
    {
        return $this->hasMany(CommercialActivity::class,);
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }
}
