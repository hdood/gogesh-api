<?php

namespace App\Http\Resources\Api\Conversation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class DetailsContactResource extends JsonResource
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
            "is_me" => $this->type == get_class(Auth::user()) ?  true : false,
            'name' => $this->sender->firstname . ' ' . $this->sender->lastname,
            'message' => $this->message,
            'attachment' => $this->attachment ? asset($this->attachment) : null,
            'avatar' => $this->type == User::class ? asset('admin.png') : ($this->sender->image ? asset($this->sender->image) : null),
            'created_at' => $this->created_at->format("Y-m-d H:i"),
            'updated_at' => $this->updated_at->format("Y-m-d H:i"),
        ];
    }
}
