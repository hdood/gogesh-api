<?php

namespace App\Http\Resources\Api\Ads;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginateAdsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => ShortInfoAdsResource::collection($this->items()),
            'meta' => [
                'total' => $this->total(),
                'current_page' => $this->currentPage(),
                'next_page' => $this->currentPage() + 1,
                'per_page' => $this->perPage(),
                'last_page' => $this->lastPage(),
            ],
        ];
    }
}
