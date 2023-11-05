<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    protected $table = "packages";
    protected $fillable = [
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
        'free_ads_duration', /// ads in ads screen
        'features',
        'features_ar',
        'status',
        'duration',
        'price',
        'max_users',
        'max_ads_via_sector_banner', /// ads in sectors screen
        'ads_via_sectors_banner_duration', /// ads in sectors screen
        'ads_discount' /// for the ads in ADS_SCREEN
    ];

    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en : $this->name_ar;
    }

    function getFeatures()
    {
        return App::getLocale() == "en" ? $this->features : $this->features_ar;
    }
}
