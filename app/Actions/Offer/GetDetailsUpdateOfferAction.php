<?php

namespace App\Actions\Offer;

use App\Repository\Dashboard\Offer\OfferRepository;
use App\Http\Resources\Api\Offer\OfferDetailsResource;

class GetDetailsUpdateOfferAction
{
    public function __construct(private readonly OfferRepository $repository)
    {
    }


    public function execute($id): OfferDetailsResource
    {
        $offer  = $this->repository->getById($id);
        return new OfferDetailsResource($offer);
    }
}
