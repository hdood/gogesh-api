<?php

namespace App\Http\Resources\Api\Seller\category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpecialitationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->speciality->id,
            "name" => $this->speciality->getName()
        ];
    }
}
