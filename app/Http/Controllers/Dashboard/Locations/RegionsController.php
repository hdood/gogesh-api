<?php

namespace App\Http\Controllers\Dashboard\Locations;

use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Dashboard\Locations\CitiesRepository;
use App\Http\Requests\Dashboard\RegionsRequest;
use App\Repository\Dashboard\Locations\RegionsRepository;
use App\Repository\Dashboard\Locations\CountriesRepository;
use App\Table\Locations\RegionsTable;
use DataTables;

class RegionsController extends Controller
{
    private $city;
    private $country;
    private $region;


    public function __construct(CitiesRepository $city, CountriesRepository $country, RegionsRepository $region)
    {
        $this->city = $city;
        $this->country = $country;
        $this->region = $region;

        $this->middleware('permission:location-list|location-create|location-edit|location-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:location-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:location-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:location-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(RegionsTable $dataTable)
    {
        return $dataTable->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = $this->country->getByStatus(EnumGeneral::ACTIVE);
        return view('localition.regions.action.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegionsRequest $request)
    {
        $this->region->create($request->validated());
        return view('localition.regions.index')->with('success', __('Success adding new region'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $region = $this->region->getById($id);
        $cities = $this->city->getByStatus(EnumGeneral::ACTIVE);

        return view('localition.regions.action.edit', compact('region', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegionsRequest $request, string $id)
    {
        $this->region->update($id, $request->validated());
        return to_route('location.regions.index')->with('success', __('success edit region'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->region->getById($id)->delete();
    }
}
