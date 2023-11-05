<?php

namespace App\Http\Resources\Api\Ads;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailsUpdateAdsResource extends JsonResource
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
            "place" => $this->place,
            "duration" => $this->duration,
            "date_start" => $this->date_start,
            "status" => $this->status,
            "images" => asset($this->images),
            "price" => floatval($this->price),
            "total" => floatval($this->total)
        ];
    }
}
