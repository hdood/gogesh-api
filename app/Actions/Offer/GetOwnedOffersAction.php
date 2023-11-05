<?php

namespace App\Actions\Offer;

use App\Http\Resources\Api\Offer\ShortInfoOfferResource;
use App\Http\Resources\PaginateResource;
use App\Repository\Dashboard\Offer\OfferRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class GetOwnedOffersAction
{
    public function __construct(private readonly OfferRepository $repository)
    {
    }


    public function execute(): PaginateResource
    {
        $commercialID = Auth::id();
        $offers = $this->repository->getOffersBySeller($commercialID, Request::query('status'));
        return new PaginateResource($offers, ShortInfoOfferResource::collection($offers->items()));
    }
}
