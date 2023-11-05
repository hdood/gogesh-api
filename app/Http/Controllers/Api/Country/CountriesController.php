<?php

namespace App\Http\Controllers\Api\Country;

use App\Enum\EnumGeneral;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\PaginateResource;
use App\Models\Country;
use App\Repository\Dashboard\Locations\CountriesRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CountriesController extends Controller
{

    public function __construct(private CountriesRepository $countriesRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return $this->countriesRepository->all();
        $q = FacadesRequest::query('q');
        $e = FacadesRequest::query('type');
        $response = $this->countriesRepository->getAll($q,$e);
        if ($e) {
            return new PaginateResource($response, CountryResource::collection($response));
        }
        // return $response;
        return CountryResource::collection($response);
    }

    public function show($id)
    {
        return new JsonResponse(["data" => new CountryResource($this->countriesRepository->getById((int)$id))]);
    }
}
