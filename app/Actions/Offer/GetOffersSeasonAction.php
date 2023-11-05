<?php

namespace App\Actions\Offer;

use App\Http\Resources\Api\Offer\ShortInfoOfferResource;
use App\Http\Resources\PaginateResource;
use App\Models\Offer;
use App\Repository\Api\PageableInterface;
use App\Repository\Dashboard\Offer\OfferRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class GetOffersSeasonAction
{

    public function __construct(private OfferRepository $offerRepository)
    {
    }


    public function execute()
    {
        $response = $this->offerRepository->getBySeason();
        return new PaginateResource($response, ShortInfoOfferResource::collection($response->items()));
    }
}
