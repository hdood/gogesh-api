<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function __construct($resource, private  $data)
    {
        parent::__construct($resource);
    }



    public function toArray(Request $request): array
    {
        return [
            "data" => $this->data,
            'meta' => [
                'is_last_page' => $this->currentPage() == $this->lastPage(),
                'total' => $this->total(),
                'current_page' => $this->currentPage(),
                'next_page' => $this->currentPage() + 1,
                'per_page' => $this->perPage(),
                'last_page' => $this->lastPage(),
            ],
        ];
    }
}
