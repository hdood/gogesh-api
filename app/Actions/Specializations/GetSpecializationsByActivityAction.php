<?php

namespace App\Actions\Specializations;

use App\Http\Resources\Api\category\SpecialitationResource;
use App\Http\Resources\PaginateResource;
use App\Repository\Dashboard\Categories\SpecialityRepository;
use Illuminate\Support\Facades\Request;

class GetSpecializationsByActivityAction
{
    public function __construct(private readonly SpecialityRepository $repository)
    {
    }

    public function execute($id)
    {
        $q = Request::query('q');
        $e = Request::query('type');
        $response = $this->repository->getByIdWithActivity($id, $q, $e);
        if ($e) {
            return  new PaginateResource($response, SpecialitationResource::collection($response));
            # code...
        }
        return  SpecialitationResource::collection($response);
    }
}
