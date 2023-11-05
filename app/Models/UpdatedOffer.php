<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UpdatedOffer extends Model
{
    use HasFactory;
    protected $table = "updated_offers";
    protected $fillable = [
        "title",
        'description',
        'condition',
        'price',
        'discount',
        'images',
        'specialities_id',
        'season_id',
        'duration_id',
        'bold',
        'total',
        'status',
        'offer_id',
        'reason',
        'reason_id',
        'video'
    ];

    /**
     * Get the user that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    /**
     * Get the user that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
    /**
     * Get the user that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }
    /**
     * Get the user that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class, 'season_id');
    }
    public function Reason(): BelongsTo
    {
        return $this->belongsTo(ReasonOffer::class, 'reason_id');
    }
    /**
     * Get the user that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function duration(): BelongsTo
    {
        return $this->belongsTo(DurationOffer::class, 'duration_id');
    }

    public function views(): HasMany
    {
        return $this->hasMany(OfferView::class,);
    }
    /**
     * Get the user that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    //    public function seller(): BelongsTo
    //    {
    //        return $this->belongsTo(Seller::class, 'seller_id');
    //    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class,);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
