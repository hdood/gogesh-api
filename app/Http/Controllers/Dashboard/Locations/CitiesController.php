<?php

namespace App\Http\Controllers\Dashboard\Locations;

use DataTables;
use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CitiesRequest;
use App\Repository\Dashboard\Locations\CitiesRepository;
use App\Repository\Dashboard\Locations\CountriesRepository;
use App\Table\Locations\CitiesTable;

class CitiesController extends Controller
{
    private $city;
    private $country;


    public function __construct(CitiesRepository $city, CountriesRepository $country)
    {
        $this->city = $city;
        $this->country = $country;

        $this->middleware('permission:location-list|location-create|location-edit|location-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:location-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:location-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:location-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CitiesTable $dataTable)
    {
        return $dataTable->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = $this->country->getByStatus(EnumGeneral::ACTIVE);
        return view('localition.cities.action.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CitiesRequest $request)
    {
        $this->city->create($request->validated());
        return view('localition.cities.index');
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
        $city = $this->city->getById($id);
        $countries = $this->country->getByStatus(EnumGeneral::ACTIVE);

        return view('localition.cities.action.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CitiesRequest $request, string $id)
    {
        $this->city->update($id, $request->validated());
        return to_route('location.cities.index')->with('success', __('success edit city'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->city->getById($id)->delete();
    }
}
