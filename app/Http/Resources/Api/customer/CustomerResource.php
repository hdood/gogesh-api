<?php

namespace App\Http\Resources\Api\customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email_verified' => (bool) $this->email_verified_at,
            'completed' => $this->completed == 1,
            'first_name' => $this->firstname,
            'last_name' => $this->lastname,
            'email' => $this->email,
            'image' => $this->image ? asset($this->image) : null,
            'phone' => $this->phone,
            'country' => $this->country_id ? $this->Country->getName() : $this->country,
            'city' => $this->city_id ? $this->City->getName() : $this->city,
            'region' => $this->region_id ? $this->Region->getName() : $this->region,
            'pic' => $this->image ? asset($this->image) : null,
            'active' => $this->active == 1,
            'status' => $this->status,
            'gender' => $this->gender,
            'created_at' => $this->created_at->format("Y-m-d H:i"),
        ];
    }
}
