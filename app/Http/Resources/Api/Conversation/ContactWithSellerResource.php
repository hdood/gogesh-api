<?php

namespace App\Http\Resources\Api\Conversation;

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
            "seller_id" => $this->receive->id,
            'name' => $this->receive->firstname . ' ' . $this->receive->lastname,
            'last_message' => $this->last_message,
            'avatar' => $this->receive->image ? asset($this->receive->image) : null,
            'created_at' => $this->created_at->format("Y-m-d H:i"),
        ];
    }
}
