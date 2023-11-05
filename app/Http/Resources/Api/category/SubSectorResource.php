<?php

namespace App\Http\Resources\Api\category;

use App\Http\Resources\Api\Sector\SectorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubSectorResource extends JsonResource
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
            "sector" => new SectorResource($this->sector),
            "name" => $this->getName()
        ];
    }
}
