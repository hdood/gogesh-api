<?php

namespace App\Actions\SubSector;

use App\Http\Resources\Api\category\SubSectorResource;
use App\Http\Resources\PaginateResource;
use App\Repository\Dashboard\Categories\SubSectorRepository;
use Illuminate\Support\Facades\Request;

class GetSubSectorsAction
{

    public function __construct(private SubSectorRepository $repository)
    {
    }

    public function execute()
    {
        $q = Request::query('q');
        $e = Request::query('type');
        $response = $this->repository->getActiveSubSectors($q, $e);
        if ($e) {
            return new PaginateResource($response, SubSectorResource::collection($response));
        }
        // return $response;
        return SubSectorResource::collection($response);
    }
}
