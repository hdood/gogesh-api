<?php

namespace App\Http\Resources\Api\category;

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
            "id" => $this->id,
            "activity_id" => $this->activity->id,
            "name" => $this->getName()
        ];
    }
}
