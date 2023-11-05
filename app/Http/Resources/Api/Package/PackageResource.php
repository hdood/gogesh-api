<?php

namespace App\Http\Resources\Api\Package;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            "price" => $this->price,
            "duration" => $this->duration,
            "features" => json_decode($this->getFeatures()),
        ];
    }
}
