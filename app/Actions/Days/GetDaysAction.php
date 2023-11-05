<?php

namespace App\Actions\Days;


use App\Http\Resources\Api\Offer\DayResource;
use App\Repository\Day\DaysRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetDaysAction
{

    public function __construct(private DaysRepository $repository)
    {
    }

    public function execute(): ResourceCollection
    {
        return DayResource::collection($this->repository->getDays());
    }

}
