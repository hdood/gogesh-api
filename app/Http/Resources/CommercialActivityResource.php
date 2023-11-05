<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommercialActivityResource extends JsonResource
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
            "name" => $this->name,
            'verification' => $this->seller->verification,
            "description" => $this->id,
            "phone" => $this->phone,
            "address" => $this->address,
            "delivery" => $this->delivery == "1",
            "delivery_value" => $this->delivery_value,
            "type" => $this->type,
            "commercial_number" => $this->commercial_number,
            "work_days" => json_decode($this->work_days),
            "social_accounts" => json_decode($this->social_accounts),
            "logo" =>  asset($this->logo),
            "commercial_register" =>  asset($this->commercial_register),
            "commercial_signature" =>  asset($this->commercial_signature),
        ];
    }
}
