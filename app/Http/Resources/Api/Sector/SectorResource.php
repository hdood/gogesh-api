<?php

namespace App\Http\Resources\Api\Sector;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectorResource extends JsonResource
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
            "name" => $this->getName(),
            "sellers_count" => $this->sellers_count,
            "image" => $this->icon ? asset($this->icon) : null,
        ];
    }
}
