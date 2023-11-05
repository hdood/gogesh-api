<?php

namespace App\Http\Controllers\Api\Activity;

use App\Actions\Activity\GetActivitiesAction;
use App\Actions\Activity\GetActivitiesBySectorAction;
use App\Actions\Specializations\GetSpecializationsByActivityAction;
use App\Http\Controllers\Controller;


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetActivitiesAction $action)
    {
        return $action->execute();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, GetSpecializationsByActivityAction $action)
    {
        return $action->execute($id);
    }
    public function getBySector(int $id, GetActivitiesBySectorAction $action)
    {
        return $action->execute($id);
    }
}
