<?php

namespace App\Actions\Services;

use App\Enum\EnumGeneral;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\Api\Services\SectionsResource;
use App\Repository\Dashboard\Services\SectionRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetSectionsAction
{

    public function __construct(private SectionRepository $repository)
    {
    }

    public function execute(): ResourceCollection
    {
        $response = $this->repository->getByStatus(EnumGeneral::ACTIVE);
        return SectionsResource::collection($response);
    }
}
