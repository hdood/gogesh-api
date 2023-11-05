<?php

namespace App\Actions\Offer;

use App\Repository\Dashboard\Offer\OfferRepository;
use App\Http\Resources\Api\Offer\UpdatedOfferResource;

class GetUpdatedOfferAction
{
    public function __construct(private readonly OfferRepository $repository)
    {
    }


    public function execute($id): UpdatedOfferResource
    {
        $offer  = $this->repository->GetUpdatedOffer($id);
        return new UpdatedOfferResource($offer);
    }
}
