<?php

namespace App\Actions\Offer;


use App\Http\Resources\CreatedOfferResource;
use App\Repository\Dashboard\Offer\OfferRepository;
use Illuminate\Support\Facades\Auth;

class GetOwnedOfferDetailsAction
{

    public function __construct(private readonly OfferRepository $repository)
    {
    }

    public function execute(int $id): CreatedOfferResource
    {
        $commercialID = Auth::id();

        return new CreatedOfferResource($this->repository->getSellerOfferById($commercialID, $id));
    }
}
