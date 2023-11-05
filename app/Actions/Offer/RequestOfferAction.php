<?php

namespace App\Actions\Offer;


use App\Repository\CustomerOffersRepository;
use App\Repository\Dashboard\Offer\OfferRepository;
use Illuminate\Support\Facades\Auth;

class RequestOfferAction
{

    public function __construct(private readonly CustomerOffersRepository $repository)
    {
    }

    public function execute(int $id):void
    {
        $this->repository->create($id,Auth::id());
    }

}
