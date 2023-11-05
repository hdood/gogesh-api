<?php

namespace App\Actions\Season;

use App\Http\Resources\Api\category\SeasonsResource;
use App\Repository\Dashboard\Categories\SeasonRepository;

class GetSeasonByIdAction
{
    public function __construct(private readonly SeasonRepository $repository)
    {
    }

    public function execute($id):SeasonsResource
    {
        return new SeasonsResource($this->repository->getById($id));
    }
}
