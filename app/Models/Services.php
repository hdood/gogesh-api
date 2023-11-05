<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Services extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'icon',
        'status',
    ];
    use HasFactory;

    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en : $this->name_ar;
    }
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'service_id');
    }
    public function comercialActivity()
    {
        return Seller::whereJsonContains('services_id', (int)$this->id)->get();
    }
}
