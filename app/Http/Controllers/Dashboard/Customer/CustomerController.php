<?php

namespace App\Http\Controllers\Dashboard\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Dashboard\CustomerRepository;
use App\Repository\Dashboard\Locations\CitiesRepository;
use App\Http\Requests\Dashboard\Customer\CustomerRequest;
use App\Repository\Dashboard\Locations\RegionsRepository;
use App\Repository\Dashboard\Locations\CountriesRepository;
use App\Http\Requests\Dashboard\Customer\CustomerUpdateRequest;
use App\Http\Requests\Dashboard\Customer\UpdatePasswordRequest;
use App\Models\Conversation;
use App\Models\Customer;
use App\Models\Support;
use App\Table\Customer\CustomerTable;

class CustomerController extends Controller
{
    private $customer;
    private $country;
    private $city;
    private $region;


    public function __construct(CustomerRepository $customer, CountriesRepository $country, CitiesRepository $city, RegionsRepository $region)
    {
        $this->customer = $customer;
        $this->country = $country;
        $this->city = $city;
        $this->region = $region;
        // $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CustomerTable $dataTable)
    {
        return $dataTable->render();
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = $this->country->all();
        $cities = $this->city->all();
        $regions = $this->region->all();
        $jsonFilePath = public_path('static/json/countries.json');
        // Read and decode the JSON data
        $jsonContent = file_get_contents($jsonFilePath);
        $country_code = json_decode($jsonContent);
        return view('customer.action.create', compact('countries', 'regions', 'cities', 'country_code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $this->customer->create($request->validated());
        return to_route('customer.index')->with('success', __('Successfully created customer'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $customer = $this->customer->getById($id);
        // return explode('-', $customer->phone);

        $countries = $this->country->all();
        $cities = $this->city->all();
        $regions = $this->region->all();
        $jsonFilePath = public_path('static/json/countries.json');
        // Read and decode the JSON data
        $jsonContent = file_get_contents($jsonFilePath);
        $country_code = json_decode($jsonContent);
        return view('customer.action.edit', compact('customer', 'countries', 'regions', 'cities', 'country_code'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        if (!empty($request->country_id)) {
            $data['country'] = null;
            $data['city'] = null;
            $data['region'] = null;
        }
        $this->customer->update($id, $data);
        return to_route('customer.index')->with('success', __('Succefully updated customer'));
    }

    /**
     * Update Password
     */
    public function updatePassword(UpdatePasswordRequest $request, string $id)
    {
        $this->customer->updatePassword($id, $request->validated());
        return response()->json(['success' => __('Succefully updated password')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->customer->getById($id)->delete();
        Support::where('type', Customer::class)->where('account_id', $id)->delete();
        Conversation::where('type_sender', Customer::class)->where('sender_id', $id)->delete();
    }
}
