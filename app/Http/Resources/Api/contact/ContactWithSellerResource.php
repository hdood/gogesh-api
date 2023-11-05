<?php

namespace App\Http\Resources\Api\contact;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactWithSellerResource extends JsonResource
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
            "seller_id" => $this->seller_id ,
            'name' => $this->seller_id ? $this->seller->firstname . ' ' . $this->seller->lastname : 'Support',
            'last_message' => $this->last_message,
            'status' => $this->status_customer,
            'avatar' => $this->seller_id ? ($this->seller->image ? asset($this->seller->image): null) : null,
            'created_at' => $this->created_at,
        ];
    }
}
