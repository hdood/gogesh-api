<?php

namespace App\Http\Resources\Api\Support;

use App\Models\User;
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
            "contact_id" => $this->support_id,
            "is_me" =>   $this->type == get_class(Auth::user()) ?  true : false,
            "name" => $this->type == User::class ?  __('Support') : $this->sender->firstname . ' ' . $this->sender->lastname,
            "message" => $this->message,
            'attachment' => $this->attachment ? asset($this->attachment) : null,
            "created_at" => $this->created_at->format("Y-m-d H:i")
        ];
    }
}
