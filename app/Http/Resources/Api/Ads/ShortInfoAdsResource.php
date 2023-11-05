<?php

namespace App\Http\Resources\Api\Ads;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortInfoAdsResource extends JsonResource
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
            "seller_id" => $this->seller ? $this->seller->id : null,
            "poster" => $this->poster,
            "views" => $this->views_count,
            'verification' => $this->seller ? $this->seller->verification == 1 : null,
            "title" => $this->title,
            "description" => $this->description,
            "price" => $this->price,
            "url" => $this->url,
            "total" => $this->total,
            "images" => asset($this->images)
        ];
    }
}
