<?php

namespace App\Actions\subscription;

use App\Http\Resources\Api\subscription\SubscriptionResource;
use App\Repository\Api\SellerRepository;

class ActiveCommercialActivityAction
{

    public function __construct(private readonly SellerRepository $repository)
    {
    }

    public function execute($id)
    {
        return new SubscriptionResource($this->repository->actived($id));
    }
}
