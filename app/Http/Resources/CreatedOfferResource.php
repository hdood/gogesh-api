<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\category\ActivityResource;
use App\Http\Resources\Api\Offer\DurationResource;
use App\Http\Resources\Api\Offer\ReasonResource;
use App\Http\Resources\Api\Sector\SectorResource;
use App\Http\Resources\Api\Seller\category\SpecialitationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreatedOfferResource extends JsonResource
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
            "updated_id" => $this->updated_id,
            "reason_updated" => $this->updated_id ? new ReasonResource($this->updatedOffer->Reason) : null,
            "title" => $this->title,
            "description" => $this->description,
            "condition" => $this->condition,
            "price" => floatval($this->price),
            "total" => floatval($this->total),
            "discount" => floatval($this->price),
            "status" => $this->status,
            "reason" => new ReasonResource($this->reason),
            "duration" => new DurationResource($this->duration),
            "sector" => new SectorResource($this->seller->sector),
            "activity" => new ActivityResource($this->seller->activity),
            'specialities_id' => SpecialitationResource::collection($this->seller->specialities),
            "bold" => $this->bold == "1",
            "images" => array_map(function ($item) {
                return asset($item);
            }, json_decode($this->images)),
            "video" => $this->video ? asset($this->video) : null
        ];
    }
}
