<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerSeason extends Model
{
    use HasFactory;
    protected $table = 'seller_season';
    protected $fillable = [
        'seller_id',
        'season_id'
    ];

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }
}
