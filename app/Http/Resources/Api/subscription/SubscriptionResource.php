<?php

namespace App\Http\Resources\Api\subscription;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getName(),
            'max_offers' => $this->max_offers,
            'offer_addition_cost' => $this->offer_addition_cost,
            'max_offer_change' => $this->max_offer_change,
            'offer_change_cost' => $this->offer_change_cost,
            'max_specialties' => $this->max_specialties,
            'specialty_addition_cost' => $this->specialty_addition_cost,
            'notification_cost' => $this->notification_cost,
            'max_ads_per_notification' => $this->max_ads_per_notification,
            'max_free_ads' => $this->max_free_ads,
            'free_ads_duration' => $this->free_ads_duration,
            'features' => json_decode($this->getFeatures()),
            'duration' => $this->duration,
            'price' => $this->price,
            'max_users' => $this->max_users,
            'max_ads_via_sector_banner' => $this->max_ads_via_sector_banner,
            'ads_via_sectors_banner_duration' => $this->ads_via_sectors_banner_duration,
            'ads_discount' => $this->ads_discount,
        ];
    }
}
