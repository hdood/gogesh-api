<?php

namespace App\Actions\Season;

use App\Enum\EnumGeneral;
use App\Http\Resources\Api\category\SeasonsResource;
use App\Http\Resources\PaginateResource;
use App\Repository\Dashboard\Categories\SeasonRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Request;

class GetSeasonsAction
{
    public function __construct(private readonly SeasonRepository $repository)
    {
    }

    public function execute()
    {
        $e = Request::query('type');
        $q = Request::query('q');
        $response = $this->repository->getByStatus(EnumGeneral::ACTIVE, $q, $e);
        if ($e) {
            return new PaginateResource($response, SeasonsResource::collection($response));
        }
        return SeasonsResource::collection($response);
    }
}
