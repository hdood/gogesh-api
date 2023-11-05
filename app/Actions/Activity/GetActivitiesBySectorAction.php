<?php

namespace App\Actions\Activity;

use App\Http\Resources\Api\category\ActivityResource;
use App\Http\Resources\PaginateResource;
use App\Repository\Dashboard\Categories\ActivityRepository;
use Illuminate\Support\Facades\Request;

class GetActivitiesBySectorAction
{

    public function __construct(private ActivityRepository $repository)
    {
    }


    public function execute($id)
    {
        $e = Request::query('type');
        $response = $this->repository->getBySector($id, $e);
        if (!$e) {
            return new PaginateResource($response, ActivityResource::collection($response));
        }
        // return $response;
        return ActivityResource::collection($response);
    }
}
