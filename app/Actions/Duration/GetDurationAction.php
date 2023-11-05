<?php

namespace App\Actions\Duration;

use App\Http\Resources\Api\Offer\DurationResource;
use App\Repository\Dashboard\Offer\DurationRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetDurationAction
{
    public function __construct(private readonly DurationRepository $repository)
    {
    }


    public function execute():ResourceCollection
    {
        return DurationResource::collection($this->repository->getActiveDuration());
    }

}
