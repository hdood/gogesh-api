<?php

namespace App\Http\Resources\Api\customer;

use App\Http\Resources\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageCustomerResource extends JsonResource
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
            "is_me" =>   $this->type == Customer::class ?  true : false,
            "name" => $this->type == User::class ? $this->user->name : $this->user->firstname . ' ' . $this->user->lastname,
            "message" => $this->message,
            "attachment" => !empty($this->attachment) ? asset($this->attachment) : null,
            "created_at" => $this->created_at
        ];
    }
}
