<?php

namespace App\Http\Controllers\Dashboard\Locations;

use DataTables;
use App\Models\Country;
use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CountriesRequest;
use App\Repository\Dashboard\Locations\CountriesRepository;
use App\Table\Locations\CountriesTable;

class CountriesController extends Controller
{

    private $country;


    public function __construct(CountriesRepository $country)
    {
        $this->country = $country;
        $this->middleware('permission:location-list|location-create|location-edit|location-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:location-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:location-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:location-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CountriesTable $dataTable)
    {
        return $dataTable->render();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('localition.countries.action.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountriesRequest $request)
    {
        $this->country->create($request->validated());
        return view('localition.countries.index')->with('success', __('Success adding new country'));
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
        $country = $this->country->getById($id);
        return view('localition.countries.action.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountriesRequest $request, string $id)
    {
        $this->country->update($id, $request->validated());
        return to_route('location.countries.index')->with('success', __('success edit country'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->country->getById($id)->delete();
    }
}
