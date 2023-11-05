<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\App;

class Season extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'season_start',
        'season_end',
        'status',
    ];
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en : $this->name_ar;
    }
}
