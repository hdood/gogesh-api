<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'offer_id',
        'bold',
        'duration_id',
        'total',
        'status'
    ];

    public function commercialActivity(): BelongsTo
    {
        return $this->belongsTo(offer::class, 'offer_id');
    }
}
