<?php

namespace App\Actions\Package;

use App\Enum\EnumGeneral;
use App\Http\Resources\Api\Package\PackageResource;
use App\Repository\Dashboard\Package\PackageRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetPackageAction
{

    public function __construct(private PackageRepository $repository)
    {
    }

    public function execute(): ResourceCollection
    {
        return PackageResource::collection($this->repository->getByStatus(EnumGeneral::ACTIVE));
    }
}
