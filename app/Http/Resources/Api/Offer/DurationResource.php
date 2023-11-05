<?php

namespace App\Http\Resources\Api\Offer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DurationResource extends JsonResource
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
            "type" => __($this->type),
            "duration" => $this->duration,
            "price" => $this->price
        ];
    }
}
