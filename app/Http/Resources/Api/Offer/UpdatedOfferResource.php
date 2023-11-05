<?php

namespace App\Http\Resources\Api\Offer;

use App\Http\Requests\Dashboard\Categories\SeasonRequest;
use App\Http\Resources\Api\category\ActivityResource;
use App\Http\Resources\Api\Sector\SectorResource;
use App\Http\Resources\Api\Seller\category\SpecialitationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdatedOfferResource extends JsonResource
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
            "title" => $this->title,
            "description" => $this->description,
            "condition" => $this->condition,
            "price" => $this->price,
            "discount" => $this->discount,
            "bold" => $this->bold == 1,
            "sector" => new SectorResource($this->sector),
            "activity" => new ActivityResource($this->activity),
            "specialities" => new SpecialitationResource($this->specialities),
            "season" => new SeasonRequest($this->season),
            "duration" => new DurationResource($this->duration),
            "images" => array_map(function ($item) {
                return asset($item);
            }, json_decode($this->images)),
            "video" => $this->video ? asset($this->video) : null

        ];
    }
}
