<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id

 */
class Seller extends Authenticatable implements MustVerifyEmail
{

    use HasFactory, HasApiTokens, Notifiable;

    protected $hidden = array('password');


    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'gender',
        'active',
        'country_id',
        'city_id',
        'region_id',
        'country',
        'city',
        'region',
        'status',
        'type',
        'image',
        'fcm_token',
        'password',
        'reason',
        'reason_update',
        'actived',
        'commercial_activity_name',

        'activity_id',
        'sub_sector_id',
        'sector_id',

        'commercial_activity_description',
        'commercial_activity_phone',

        'civil_card',
        'commercial_license',
        'signature_approval',

        'upgraded',
        'upgraded_status',

        'logo',

        'delivery',
        'delivery_price',

        'social_accounts',
        'work_days',

        'verification',
        'completed',

        'address',

    ];

    /**
     * Get the company associated with the Seller
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function commercialActivity(): HasOne
    {
        return $this->hasOne(CommercialActivity::class, 'seller_id');
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new EmailVerificationNotification());
    }
    public function Country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function City(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function Region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }
    public function subSector(): BelongsTo
    {
        return $this->belongsTo(SubSector::class, 'sub_sector_id');
    }
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
    public function updateCommercial(): HasOne
    {
        return $this->hasOne(UpdateCommercialActivity::class, 'commercial_activity_id');
    }
    public function sections()
    {
        return $this->hasMany(SellerSection::class, 'seller_id');
    }
    public function services()
    {
        return $this->hasMany(SellerService::class, 'seller_id');
    }
    public function seasons()
    {
        return $this->hasMany(SellerSeason::class, 'seller_id');
    }

    public function specialities()
    {
        return $this->hasMany(SellerSpeciality::class, 'seller_id');
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
        return $this->hasOne(Subscription::class, 'seller_id');
    }
    public function users(): HasMany
    {
        return $this->hasMany(UserCommecrialActivity::class, 'seller_id');
    }
}
