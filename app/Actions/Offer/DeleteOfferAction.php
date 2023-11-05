<?php

namespace App\Actions\Offer;


use App\Repository\Dashboard\Offer\OfferRepository;

class DeleteOfferAction
{

    public function __construct(private readonly  OfferRepository $repository)
    {
    }

    public function execute($id): void
    {
       $this->repository->delete($id);
    }

}
