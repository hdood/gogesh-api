<?php

namespace App\Http\Resources\Api\contact;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MessageResource extends JsonResource
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
            "contact_id" => $this->contact_id,
            "is_me" => false,
            "name" => Auth::user()->name,
            "message" => $this->message,
            "attachment" => !empty($this->attachment) ? asset($this->attachment) : null,
            "created_at" => $this->created_at
        ];
    }
}
