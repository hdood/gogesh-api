<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        "model",
        "ad_id",
        "offer_id",
        "customer_id",
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }


}
