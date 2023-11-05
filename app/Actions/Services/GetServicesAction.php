<?php

namespace App\Actions\Services;

use App\Enum\EnumGeneral;
use App\Http\Resources\Api\Services\ServicesResource;
use App\Http\Resources\PaginateResource;
use App\Repository\Dashboard\Services\ServiceRepository;
use Illuminate\Support\Facades\Request;

class GetServicesAction
{

    public function __construct(private ServiceRepository $repository)
    {
    }

    public function execute()
    {
        $e = Request::query('type');
        $q = Request::query('q');
        $response = $this->repository->getByStatus(EnumGeneral::ACTIVE, $q, $e);
        if ($e) {
            return new PaginateResource($response, ServicesResource::collection($response));
        }
        return ServicesResource::collection($response);
    }
}
