<?php

namespace App\Http\Controllers\Dashboard\CommercialActivity;


use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Dashboard\Offer\ReasonRepository;
use App\Repository\Dashboard\Categories\SectorRepository;
use App\Table\CommercialActivity\CommercialActivityTable;
use App\Repository\Dashboard\Categories\ActivityRepository;
use App\Http\Requests\Dashboard\Comapny\UpdateComapnyRequest;
use App\Repository\Dashboard\CommercialActivity\CommercialActivityRepository;
use Illuminate\Support\Arr;

class CommercialActivityController extends Controller
{
    private $commercialActivity;
    private $sector;
    private $activity;
    private $reason;

    public function __construct(CommercialActivityRepository $commercialActivity, SectorRepository $sector, ActivityRepository $activity, ReasonRepository $reason)
    {
        $this->commercialActivity = $commercialActivity;
        $this->sector = $sector;
        $this->activity = $activity;
        $this->reason = $reason;

        $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:company-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:company-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CommercialActivityTable $dataTable)
    {
        return $dataTable->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $activities = $this->activity->all();
        $sectors = $this->sector->all();
        $reasons = $this->reason->all();
        $commercialActivity = $this->commercialActivity->getById($id);
        $commercialActivityUpdate = $commercialActivity->updateCommercial;
        $jsonFilePath = public_path('static/json/countries.json');
        // Read and decode the JSON data
        $jsonContent = file_get_contents($jsonFilePath);
        $country_code = json_decode($jsonContent);
        return view('commercialActivity.action.edit', compact('activities', 'sectors', 'commercialActivity', 'commercialActivityUpdate', 'reasons', 'country_code'));
    }

    public function approvedUpdate(string $id)
    {
        $commercialActivity = $this->commercialActivity->getById($id);
        $commercialActivityUpdate = $commercialActivity->updateCommercial;
        $array = Arr::except(json_decode($commercialActivityUpdate, true), ['id', 'commercial_activity_id']);
        $data = array_filter($array, function ($value) {
            return $value !== null && $value !== "";
        });
        $data['status'] = $commercialActivity->status;
        $this->commercialActivity->updateApproved($id, $data);
        $commercialActivity->seasons()->detach();
        $commercialActivity->seasons()->sync((json_decode($array["seasons"])));
        $commercialActivityUpdate->delete();
        $commercialActivity->status = EnumGeneral::APPROVED;
        $commercialActivity->save();
        return to_route('commercialActivity.index');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComapnyRequest $request, string $id)
    {
        $this->commercialActivity->update($id, $request->validated());
        return to_route('commercialActivity.index')->with('success', 'commercialActivity edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->commercialActivity->getById($id)->delete();
    }
}
