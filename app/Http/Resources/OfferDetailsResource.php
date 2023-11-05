<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\Seller\ShortInfoSellerResource;
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
            "title" => $this->title,
            'verification' => $this->seller->verification == 0,
            "description" => $this->description,
            "condition" => $this->condition,
            "price" => $this->price,
            "bold" => $this->bold == 1,
            "views" => $this->views_count,
            "fav" => $this->getIsFavoriteAttribute(),
            "type" => $this->seller->type,
            "seller" => new ShortInfoSellerResource($this->seller),
            "created_at" => $this->created_at->format("Y-m-d H:i"),
            "images" => array_map(function ($item) {
                return asset($item);
            }, json_decode($this->images)),
            "video" => $this->video ? asset($this->video) : null
        ];
    }
}
