<?php

namespace App\Actions\Services;

use App\Enum\EnumGeneral;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\Api\Services\SectionsResource;
use App\Repository\Dashboard\Services\SectionRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Request;

class GetSectionsByIdAction
{

    public function __construct(private SectionRepository $repository)
    {
    }

    public function execute($id)
    {
        $e = Request::query('type');
        $q = Request::query('q');
        $response = $this->repository->getByIdWithService($id, $q, $e);
        if ($e) {
            return new PaginateResource($response, SectionsResource::collection($response));
        }
        return SectionsResource::collection($response);
    }
}
