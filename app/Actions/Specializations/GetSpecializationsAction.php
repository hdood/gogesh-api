<?php

namespace App\Actions\Specializations;

use App\Http\Resources\Api\category\SpecialitationResource;
use App\Http\Resources\PaginateResource;
use App\Repository\Dashboard\Categories\SpecialityRepository;
use Illuminate\Support\Facades\Request;

class GetSpecializationsAction
{
    public function __construct(private readonly SpecialityRepository $repository)
    {
    }

    public function execute()
    {
        $q = Request::query('q');
        $e = Request::query('type');
        $response = $this->repository->getActiveSpecializations($q, $e);
        if ($e) {
            # code...
            return  new PaginateResource($response, SpecialitationResource::collection($response));
        }
        return  SpecialitationResource::collection($response);
    }
}
