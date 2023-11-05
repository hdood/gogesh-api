<?php

namespace App\Models;

use App\Models\UpdatedOffer;
use SebastianBergmann\Timer\Duration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        'description',
        'condition',
        'price',
        'discount',
        'images',
        // 'speciality_id',
        "seller_id",
        // 'sector_id',
        // 'activity_id',
        'start_at',
        'end_at',
        'season_id',
        'duration_id',
        'bold',
        'total',
        'status',
        'old_status',
        'reason_id',
        'video',
        'approved_at'
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

    public function updatedOffer(): HasOne
    {
        return $this->hasOne(UpdatedOffer::class, 'offer_id');
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


    public function specialities()
    {
        return $this->hasMany(OfferSpeciality::class, 'offer_id');
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
    public function reason(): BelongsTo
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

    public function commercialActivity(): BelongsTo
    {
        return $this->belongsTo(CommercialActivity::class, 'commercial_activity_id');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class,);
    }

    public function getIsFavoriteAttribute()
    {
        $customerId = Auth::guard("sanctum")->id();

        return $this->favorites()->where('customer_id', $customerId)->exists();
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(OfferTransaction::class, 'offer_id');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'offer_id');
    }
}
