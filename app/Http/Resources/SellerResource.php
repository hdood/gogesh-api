<?php

namespace App\Http\Resources;

use App\Enum\EnumGeneral;
use App\Http\Resources\Api\Seller\Category\ActivityResource;
use App\Http\Resources\Api\Seller\Category\SectorResource;
use App\Http\Resources\Api\Seller\Category\SubSectorResource;
use App\Http\Resources\Api\Seller\SelleUpgraderResource;
use App\Http\Resources\Api\Seller\Services\SectionsResource;
use App\Http\Resources\Api\Seller\Services\ServicesResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
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
            'email_verified' => (bool) $this->email_verified_at,
            'first_name' => $this->firstname,
            'last_name' => $this->lastname,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'reason' => ($this->status == EnumGeneral::INACTIVE || $this->status == EnumGeneral::REJECTED) ? $this->reason : null,
            'country' => $this->country_id ? $this->Country->getName() : $this->country,
            'city' => $this->city_id ? $this->City->getName() : $this->city,
            'region' => $this->region_id ? $this->Region->getName() : $this->region,
            'services_id' => ServicesResource::collection($this->services),
            'sections_id' =>  SectionsResource::collection($this->sections),
            'type' => $this->type,
            'commercial_activity_name' => $this->commercial_activity_name,
            'commercial_activity_description' => $this->commercial_activity_description,
            'commercial_activity_phone' => $this->commercial_activity_phone,
            'sector_id' => new SectorResource($this->sector),
            'sub_sector_id' => new SubSectorResource($this->subSector),
            'activity_id' => new ActivityResource($this->activity),
            'active' => $this->active == 1,
            'status' => $this->status,
            'image' => $this->image ? asset($this->image) : null,
            'civil_card' => $this->civil_card ? asset($this->civil_card) : null,
            'commercial_license' => $this->commercial_license ? asset($this->commercial_license) : null,
            'signature_approval' => $this->signature_approval ? asset($this->signature_approval) : null,
            'verification' => $this->verification == 1,
            'actived' => $this->actived == 1,
            'completed' => $this->completed == 1,
            'upgraded' => $this->upgraded == 1 ? new SelleUpgraderResource($this) : null,
            'created_at' => $this->created_at->format("Y-m-d H:i"),
        ];
    }
}
