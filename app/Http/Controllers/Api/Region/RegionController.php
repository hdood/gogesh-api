<?php

namespace App\Http\Controllers\Api\Region;

use App\Enum\EnumGeneral;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\RegionResource;
use App\Repository\Dashboard\Locations\RegionsRepository;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegionController extends Controller
{
    public function __construct(private RegionsRepository $regionsRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $q = Request::query('q');
        $e = Request::query('type');
        $response = $this->regionsRepository->getAll($q, $e);
        if ($e) {
            return new PaginateResource($response, RegionResource::collection($response));
        }
        // return $response;
        return RegionResource::collection($response);
    }

    public function show($id): JsonResponse
    {
        return new JsonResponse(["data" =>  new RegionResource($this->regionsRepository->getById((int)$id))]);
    }

    public function getRegionsByCityId($cityId)
    {
        $q = Request::query('q');
        $e = Request::query('type');
        $response = $this->regionsRepository->getByCity((int)$cityId, $q, $e);
        if ($e) {
            return new PaginateResource($response, RegionResource::collection($response));
        }
        // return $response;
        return RegionResource::collection($response);
    }
}
