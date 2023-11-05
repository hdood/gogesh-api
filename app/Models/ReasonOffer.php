<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ReasonOffer extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
    ];



    function getTitle()
    {
        return App::getLocale() == "en" ? $this->title_en : $this->title_ar;
    }

    function getDescription()
    {
        return App::getLocale() == "en" ? $this->description_en : $this->description_ar;
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'reason_id');
    }
}
