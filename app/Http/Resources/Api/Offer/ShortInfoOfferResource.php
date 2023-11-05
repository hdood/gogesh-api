<?php

namespace App\Http\Resources\Api\Offer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortInfoOfferResource extends JsonResource
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
            "reason" => new ReasonResource($this->reason),
            "updated_id" => $this->updated_id,
            "reason_updated" => $this->updated_id ? new ReasonResource($this->updatedOffer->Reason) : null,
            "title" => $this->title,
            'verification' => $this->seller ? $this->seller->verification == 1 : null,
            'commercialActivity' => $this->seller->commercial_activity_name,
            "description" => $this->description,
            "bold" => $this->bold == 1,
            "fav" => ($this->is_favorite ?? "0") == "1",
            "condition" => $this->condition,
            "created_at" => $this->created_at->format("Y-m-d H:i"),
            "views" => $this->views_count,
            "price" => $this->price,
            "discount" => $this->discount,

            "images" => array_map(function ($item) {
                return asset($item);
            }, json_decode($this->images))
        ];
    }
}
