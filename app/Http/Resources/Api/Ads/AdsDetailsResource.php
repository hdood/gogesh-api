<?php

namespace App\Http\Resources\Api\Ads;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsDetailsResource extends JsonResource
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
            'verification' => $this->verification,
            "status" => $this->status,
            "price" => $this->price,
            "views" => $this->views_count,
            "seller" => $this->seller ? $this->seller->firstname . ' ' . $this->seller->lastname : null,
            "seller_id" => $this->seller ? $this->seller->id : null,
            "poster" => $this->poster,
            "type_commercialActivity" => $this->seller ? $this->seller->type : $this->poster_type,
            "created_at" => $this->created_at->format("Y-m-d H:i"),
            "images" => asset($this->images),
            "url" => $this->url,
        ];
    }
}
