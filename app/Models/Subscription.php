<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'name_ar',
        'name_en',
        'max_offers',
        'offer_addition_cost',
        'max_offer_change',
        'offer_change_cost',
        'max_specialties',
        'specialty_addition_cost',
        'notification_cost',
        'max_ads_per_notification',
        'max_free_ads', /// ads in ads screen
        'free_ads_duration', /// ads in ads screen in days
        'features',
        'features_ar',
        'duration',
        'price',
        'max_users',
        'max_ads_via_sectors_banner', /// ads in sectors screen
        'ads_via_sectors_banner_duration', /// ads in sectors screen
        'ads_discount' /// for the ads in ADS_SCREEN
    ];


    public function commercialActivity(): BelongsTo
    {
        return $this->belongsTo(CommercialActivity::class, 'commercial_activity_id');
    }
    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en : $this->name_ar;
    }

    function getFeatures()
    {
        return App::getLocale() == "en" ? $this->features : $this->features_ar;
    }
}
