<?php

namespace App\Http\Resources\Api\Seller;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortInfoSellerResource extends JsonResource
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
            'first_name' => $this->firstname,
            'last_name' => $this->lastname,
            'verification' => $this->verification == 1,

        ];
    }
}
