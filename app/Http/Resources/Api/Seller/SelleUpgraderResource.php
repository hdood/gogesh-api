<?php

namespace App\Http\Resources\Api\Seller;

use App\Http\Resources\Api\Seller\Category\SeasonsResource;
use App\Http\Resources\Api\Seller\Category\SpecialitationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SelleUpgraderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'upgraded_status' => $this->upgraded_status,
            'logo' => asset($this->logo),
            'specialities_id' => SpecialitationResource::collection($this->specialities),
            'seasons_id' => SeasonsResource::collection($this->seasons),
            "work_days" => json_decode($this->work_days),
            "social_accounts" => json_decode($this->social_accounts),
            'delivery_price' => $this->delivery_price
        ];
    }
}
