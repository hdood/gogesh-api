<?php

namespace App\Http\Controllers\Api\City;

use App\Enum\EnumGeneral;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\PaginateResource;
use App\Repository\Dashboard\Locations\CitiesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CityController extends Controller
{
    public function __construct(private CitiesRepository $citiesRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $q = FacadesRequest::query('q');
        $e = FacadesRequest::query('type');
        $response = $this->citiesRepository->getAll($q, $e);
        if ($e) {
            return new PaginateResource($response, CityResource::collection($response));
        }
        // return $response;
        return CityResource::collection($response);
    }

    public function show($id)
    {
        return new CityResource($this->citiesRepository->getById((int)$id));
    }

    public function getCitiesByCountryId($countryId)
    {
        $q = FacadesRequest::query('q');
        $e = FacadesRequest::query('type');
        $response = $this->citiesRepository->getByCountry((int) $countryId, $q, $e);
        if ($e) {
            return new PaginateResource($response, CityResource::collection($response));
        }
        // return $response;
        return CityResource::collection($response);
    }
}
