<?php

namespace App\Actions\Offer;

use App\Http\Resources\Api\Offer\ShortInfoOfferResource;
use App\Http\Resources\PaginateResource;
use App\Repository\Dashboard\Offer\OfferRepository;


class GetOffersMostRequestAction
{

    public function __construct(private OfferRepository $offerRepository)
    {
    }


    public function execute()
    {
        $response = $this->offerRepository->mostRequest();
        return new PaginateResource($response, ShortInfoOfferResource::collection($response->items()));
    }
}
