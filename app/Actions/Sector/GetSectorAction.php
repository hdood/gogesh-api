<?php

namespace App\Actions\Sector;

use App\Http\Resources\Api\Sector\SectorResource;
use App\Http\Resources\PaginateResource;
use App\Repository\Dashboard\Categories\SectorRepository;
use Illuminate\Support\Facades\Request;

class GetSectorAction
{

    public function __construct(private SectorRepository $repository)
    {
    }

    public function execute(): array|PaginateResource
    {
        $q = Request::query("q");
        $response = $this->repository->getPaginatedSectors(Request::query("service_type"), $q);
        return new PaginateResource($response, SectorResource::collection($response->items()));
    }
}
