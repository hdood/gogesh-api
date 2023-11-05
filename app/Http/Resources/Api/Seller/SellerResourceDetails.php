<?php

namespace App\Http\Resources\Api\Seller;

use App\Http\Resources\Api\Seller\Services\SectionsResource;
use App\Http\Resources\Api\Seller\Services\ServicesResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResourceDetails extends JsonResource
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
            'first_name' => $this->firstname,
            'last_name' => $this->lastname,
            'verification' => $this->verification == 1,
            'email_verified' => (bool) $this->email_verified_at,
            'email' => $this->email,
            'phone' => $this->phone,
            'description' => $this->description,
            'active' => $this->active == 1,
            'status' => $this->status,
            'country' => $this->country_id ? $this->Country->getName() : $this->country,
            'city' => $this->city_id ? $this->City->getName() : $this->city,
            'region' => $this->region_id ? $this->Region->getName() : $this->region,
            'image' => asset($this->image),
            'commercial_activity' => $this->commercial_activity_name,
            'commercial_activity_address' => $this->address,
            'commercial_activity_social' => $this->social_accounts ? toArray(json_decode($this->social_accounts)) : null,
            'work_days' => $this->work_days ? $this->workDays() : null,
            'services' => ServicesResource::collection($this->services),
            'sections' =>  SectionsResource::collection($this->sections),
            'created_at' => $this->created_at,
        ];
    }
}
