<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ads extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        'seller_id',
        'sector_id',
        'place',
        'duration',
        'date_start',
        'date_end',
        'description',
        'images',
        'url',
        'poster',
        'poster_type',
        'price',
        'total',
        'status',
        'reason_id',
        'seller_id'
    ];

    /**
     * Get the user that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
    public function commercialActivity()
    {
        return $this->belongsTo(CommercialActivity::class, 'seller_id', 'seller_id');
    }
    public function views()
    {
        return $this->hasMany(AdsView::class,'ads_id');
    }
}
