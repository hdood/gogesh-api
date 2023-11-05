<?php

namespace App\Http\Resources\Api\Support;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->support->id,
            'name' => __('Support'),
            'last_message' => $this->support->last_message,
            'unread' => count($this->support->unreads),
            'avatar' => asset('admin.png'),
            'created_at' => $this->support->created_at->format("Y-m-d H:i"),
            'updated_at' => $this->support->updated_at->format("Y-m-d H:i"),
        ];
    }
}
