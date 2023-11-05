<?php

namespace App\Http\Resources\Api\Seller\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->service->id,
            "name" => $this->service->getName(),
            "has_sections" => count($this->service->sections) ? true : false
        ];
    }
}
