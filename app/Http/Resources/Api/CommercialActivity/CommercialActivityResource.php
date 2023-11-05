<?php

namespace App\Http\Resources\Api\CommercialActivity;

use App\Http\Resources\Api\category\ActivityResource;
use App\Http\Resources\Api\category\SeasonsResource;
use App\Http\Resources\Api\category\SpecialitationResource;
use App\Http\Resources\Api\Sector\SectorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommercialActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "status" => $this->status,
            "reason" => $this->reason,
            "name" => $this->name,
            'actived' => $this->active == 1,
            'verification' => $this->seller->verification,
            "description" => $this->description,
            "phone" => $this->phone,
            "address" => $this->address,
            "sector" => new SectorResource($this->sector),
            "activity" => new ActivityResource($this->activity),
            "speciality" => new SpecialitationResource($this->speciality),
            "season" => SeasonsResource::collection($this->seasons),
            "delivery" => $this->delivery == "1",
            "delivery_value" => $this->delivery_value,
            "type" => $this->type,
            "commercial_number" => $this->commercial_number,
            "logo" =>  asset($this->logo),
            "commercial_register" =>  asset($this->commercial_register),
            "commercial_signature" =>  asset($this->commercial_signature),
        ];
    }
}
