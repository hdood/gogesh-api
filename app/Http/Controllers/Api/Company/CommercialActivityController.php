<?php

namespace App\Http\Controllers\Api\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\CommercialActivity\CreateCommercialActivityAction;
use App\Actions\CommercialActivity\GetDetailsCommercialActivityAction;
use App\Actions\CommercialActivity\GetInformationSubscriptions;
use App\Actions\CommercialActivity\GetSocialAccountAction;
use App\Actions\CommercialActivity\GetWorkDaysAction;
use App\Actions\CommercialActivity\UpdateCommercialActivityAction;
use App\Actions\CommercialActivity\UpdateSocialAccountAction;
use App\Actions\CommercialActivity\UpdateWorkDaysAction;
use App\Http\Requests\Api\Company\CreateCommercialActivityRequest;
use App\Http\Requests\Api\Company\UpdateCommercialActivityRequest;
use App\Http\Requests\Api\Company\UpdateSocialAccountRequest;
use App\Http\Requests\Api\Company\UpdateWorkDaysRequest;
use Illuminate\Support\Facades\Auth;

class CommercialActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCommercialActivityRequest $request, CreateCommercialActivityAction $action)
    {
        return $action->execute($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCommercialActivity(UpdateCommercialActivityRequest $request, UpdateCommercialActivityAction $action)
    {
        $id = Auth::user()->CommercialActivity->id;
        return $action->execute($id, $request);
    }
    // Used
    public function updateWorkDays(UpdateWorkDaysRequest $request, UpdateWorkDaysAction $action)
    {
        $id = Auth::id();
        return $action->execute($id, $request);
    }

    public function updateSocialAccount(UpdateSocialAccountRequest $request, UpdateSocialAccountAction $action)
    {
        $id = Auth::id();
        return $action->execute($id, $request);
    }
    public function showSocialAccount(GetSocialAccountAction $action)
    {
        return $action->execute();
    }

    public function showWorkDays(GetWorkDaysAction $action)
    {
        return $action->execute();
    }
    public function informationSubscripe(GetInformationSubscriptions $action)
    {
        return $action->execute();
    }
    //End Used

    public function showDetailsCommercial(GetDetailsCommercialActivityAction $action)
    {
        return $action->execute();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
