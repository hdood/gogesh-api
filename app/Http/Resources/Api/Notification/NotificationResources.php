<?php

namespace App\Http\Resources\Api\Notification;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'offer_id' => $this->offer_id,
            'ads_id' => $this->ads_id,
            'commercial_activity_id' => $this->commercial_activity_id,
            'type' => $this->type,
            'to' => $this->to ?? $this->receive->firstname . ' ' . $this->receive->lastname,
            'created_at' => $this->created_at->format("Y-m-d H:i")
        ];
    }
}
