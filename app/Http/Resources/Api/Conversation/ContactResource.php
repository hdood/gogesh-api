<?php

namespace App\Http\Resources\Api\Conversation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            "seller_id" => $this->receive->id,
            'name' => $this->type_receive == get_class(Auth::user()) ? $this->sender->firstname . ' ' . $this->sender->lastname : $this->receive->firstname . ' ' . $this->receive->lastname,
            'last_message' => $this->last_message,
            'unread' => count($this->unreads),
            "complete" => $this->complete == 1,
            'avatar' => $this->offer_id ? ($this->offer->images ? asset(json_decode($this->offer->images)[0]) : null) : ($this->ad->images ? asset($this->ad->images) : null),
            'offer_title' => $this->offer_id ? $this->offer->title : null,
            'ad_id' =>  $this->ads_id ?? null,
            'ad_title' =>  $this->ads_id ? $this->ad->title : null,
            'updated_at' => $this->updated_at->format("Y-m-d H:i"),
            'created_at' => $this->created_at->format("Y-m-d H:i"),
        ];
    }
}
