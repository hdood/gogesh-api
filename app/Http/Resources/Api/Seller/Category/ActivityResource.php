<?php

namespace App\Http\Resources\Api\Seller\Category;

use App\Http\Resources\Api\Sector\SectorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            "code" => $this->code,
        ];
    }
}
