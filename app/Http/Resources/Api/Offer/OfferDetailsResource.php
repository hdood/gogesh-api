<?php

namespace App\Http\Resources\Api\Offer;

use App\Http\Resources\Api\category\ActivityResource;
use App\Http\Resources\Api\category\SeasonsResource;
use App\Http\Resources\Api\Sector\SectorResource;
use App\Http\Resources\Api\Seller\category\SpecialitationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferDetailsResource extends JsonResource
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
            "updated_id" => $this->updated_id,
            "reason_updated" => $this->updated_id ? new ReasonResource($this->updatedOffer->Reason) : null,
            "title" => $this->title,
            'verification' => $this->seller->verification,
            "description" => $this->description,
            "condition" => $this->condition,
            "price" => $this->price,
            "discount" => $this->discount,
            "bold" => $this->bold == 1,
            "sector" => new SectorResource($this->seller->sector),
            "activity" => new ActivityResource($this->seller->activity),
            'specialities_id' => SpecialitationResource::collection($this->specialities),
            "season" => new SeasonsResource($this->season),
            "duration" => new DurationResource($this->duration),
            "images" => array_map(function ($item) {
                return asset($item);
            }, json_decode($this->images)),
            "video" => $this->video ? asset($this->video) : null

        ];
    }
}
