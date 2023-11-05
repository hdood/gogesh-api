<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsView extends Model
{
    use HasFactory;

    protected $fillable = [
        'ads_id',
        'customer_id',
        'gust_id',
    ];
    public function ad()
    {
        return $this->belongsTo(Ads::class, 'ads_id');
    }
}
