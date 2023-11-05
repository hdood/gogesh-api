<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferView extends Model
{
    use HasFactory;

    protected $fillable = [
        "offer_id",
        "gust_id",
        "customer_id"
    ];
}
