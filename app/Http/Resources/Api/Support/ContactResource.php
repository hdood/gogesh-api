<?php

namespace App\Http\Resources\Api\Support;

use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'name' => __('Support'),
            'last_message' => $this->last_message,
            'unread' => count($this->unreads),
            'avatar' => asset('admin.png'),
            'created_at' => $this->created_at->format("Y-m-d H:i"),
            'updated_at' => $this->updated_at->format("Y-m-d H:i"),
        ];
    }
}
