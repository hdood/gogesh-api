<?php

namespace App\Actions\Activity;

use App\Enum\EnumGeneral;
use App\Http\Resources\Api\category\ActivityResource;
use App\Http\Resources\PaginateResource;
use App\Repository\Dashboard\Categories\ActivityRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Request;

class GetActivitiesAction
{

    public function __construct(private ActivityRepository $repository)
    {
    }

    public function execute()
    {
        $q = Request::query('q');
        $e = Request::query('type');
        $response = $this->repository->getActiveActivities($q, $e);
        if ($e) {
            return new PaginateResource($response, ActivityResource::collection($response));
        }
        // return $response;
        return ActivityResource::collection($response);
    }
}
