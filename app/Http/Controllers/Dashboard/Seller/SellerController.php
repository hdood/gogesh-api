<?php

namespace App\Http\Controllers\Dashboard\Seller;

use App\Enum\EnumGeneral;
use App\Repository\Dashboard\Services\ServiceRepository;

use App\Http\Controllers\Controller;
use App\Repository\Dashboard\SellerRepository;
use App\Http\Requests\Dashboard\Seller\SellerRequest;
use App\Http\Requests\Dashboard\Seller\SellerUpdateMoreRequest;
use App\Repository\Dashboard\Locations\CitiesRepository;
use App\Repository\Dashboard\Locations\RegionsRepository;
use App\Http\Requests\Dashboard\Seller\SellerUpdateRequest;
use App\Repository\Dashboard\Locations\CountriesRepository;
use App\Http\Requests\Dashboard\Seller\UpdatePasswordRequest;
use App\Models\Conversation;
use App\Models\Seller;
use App\Models\Support;
use App\Repository\Dashboard\Categories\ActivityRepository;
use App\Repository\Dashboard\Categories\SeasonRepository;
use App\Repository\Dashboard\Categories\SectorRepository;
use App\Repository\Dashboard\Categories\SpecialityRepository;
use App\Repository\Dashboard\Services\SectionRepository;
use App\Table\Seller\SellerTable;

class SellerController extends Controller
{
    private $seller;
    private $country;
    private $city;
    private $region;



    public function __construct(
        SellerRepository $seller,
        CountriesRepository $country,
        CitiesRepository $city,
        RegionsRepository $region,
        private ServiceRepository $services,
        private SectionRepository $sections,
        private ActivityRepository $activity,
        private SectorRepository $sector,
        private SpecialityRepository $speciality,
        private SeasonRepository $season
    ) {
        $this->seller = $seller;
        $this->country = $country;
        $this->city = $city;
        $this->region = $region;

        $this->middleware('permission:seller-list|seller-create|seller-edit|seller-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:seller-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:seller-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:seller-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SellerTable $dataTable)
    {

        // return $countries[0]->alpha_2_code . '-' . $countries[0]->dial_code;
        return $dataTable->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = $this->country->all();
        $services = $this->services->all();
        $sections = $this->sections->all();
        $seasons = $this->season->all();
        $jsonFilePath = public_path('static/json/countries.json');
        // Read and decode the JSON data
        $jsonContent = file_get_contents($jsonFilePath);
        $country_code = json_decode($jsonContent);
        return view('seller.action.create', compact('countries', 'services', 'seasons', 'sections', 'country_code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SellerRequest $request)
    {
        $this->seller->create($request->validated());
        return to_route('seller.index');
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
        $seller = $this->seller->getById($id);
        $countries = $this->country->all();
        $services = $this->services->all();
        $sections = $this->sections->all();
        // $activities = $this->activity->all();
        $sectors = $this->sector->all();
        $specialities = $this->speciality->getByActivity($seller->activity_id);
        $seasons = $this->season->all();

        $jsonFilePath = public_path('static/json/countries.json');
        // Read and decode the JSON data
        $jsonContent = file_get_contents($jsonFilePath);
        $country_code = json_decode($jsonContent);
        return view('seller.action.edit', compact('seller', 'countries', 'services', 'seasons', 'specialities', 'sections', 'sectors', 'country_code'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SellerUpdateRequest $request, string $id)
    {
        // return $request;
        $data = $request->validated();
        if (!empty($request->country_id)) {
            $data['country'] = null;
            $data['city'] = null;
            $data['region'] = null;
        }
        $this->seller->update($id, $data);
        return to_route('seller.index')->with('success', __('Succefully updated seller'));
    }


    public function approvedUpgrad(string $id)
    {
        $seller = Seller::findOrfail($id);
        $seller->upgraded_status = EnumGeneral::NOT_PAID;
        $seller->save();
        return to_route('seller.index');
    }
    // public function updateMore($id, SellerUpdateMoreRequest $request)
    // {
    //     return $request;
    //     $this->seller->update($id, $request->validated());
    // }
    /**
     * Update Password
     */
    public function updatePassword(UpdatePasswordRequest $request, string $id)
    {
        $this->seller->updatePassword($id, $request->validated());
        return response()->json(['success' => __('Succefully updated password')]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->seller->getById($id)->delete();
        Support::where('type', Seller::class)->where('account_id', $id)->delete();
        Conversation::where('type_receive', Seller::class)->where('receive_id', $id)->delete();
    }
}
