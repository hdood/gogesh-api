<?php

namespace App\Http\Resources\Api\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionsResource extends JsonResource
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
            "services_id" => $this->service->id,
            "name" => $this->getName(),
        ];
    }
}
