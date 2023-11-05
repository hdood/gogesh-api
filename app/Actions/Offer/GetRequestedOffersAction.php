<?php

namespace App\Actions\Offer;


use App\Repository\Dashboard\Offer\OfferRepository;
use Illuminate\Support\Facades\Auth;

class GetRequestedOffersAction
{

    public function __construct(private OfferRepository $repository)
    {
    }

    public function execute()
    {
        $id = Auth::id();

        return $this->repository->getRequestedOffers($id);
    }

}
