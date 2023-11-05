<?php

namespace App\Http\Resources\Api\contact;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactSellerResource extends JsonResource
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
            'name' => $this->customer_id ? $this->customer->firstname . ' ' . $this->customer->lastname : 'Support',
            'last_message' => $this->last_message,
            'status' => $this->status_seller,
            'avatar' => $this->account->image ? asset($this->account->image) : null,
            'created_at' => $this->created_at,
        ];
    }
}
