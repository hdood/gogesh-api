<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacesAds extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'price'
    ];
    public function ads()
    {
        return $this->hasMany(Ads::class, 'place', 'place');
    }
}
