<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CommercialActivity extends Model
{
    use HasFactory;
    /**
     * Get the seller that owns the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected $table = "commercial_activity";
    protected $fillable = [
        'name',
        'phone',
        'activity_id',
        'seller_id',
        'sector_id',
        'specialization_id',
        'social_accounts',
        'work_days',
        'type',
        'address',
        'description',
        'status',
        'active',
        'reason',
        'logo',
        'commercial_register',
        'commercial_signature',
    ];
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class,);
    }
    public function updateCommercial(): HasOne
    {
        return $this->hasOne(UpdateCommercialActivity::class, 'commercial_activity_id');
    }
    public function seasons(): BelongsToMany
    {
        return $this->belongsToMany(Season::class,);
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class, 'specialization_id');
    }
    public function workDays(): array
    {
        foreach (json_decode($this->work_days) as $key => $item) {
            $day = Day::findOrfail($item->day)->getName();
            $array[] = data_set($item, 'name', $day);
        }
        return $array;
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
    public function users(): HasMany
    {
        return $this->hasMany(UserCommecrialActivity::class, 'commercial_activity_id');
    }
}
