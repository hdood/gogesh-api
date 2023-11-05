<?php

namespace App\Http\Controllers\Api\Sector;

use App\Actions\Activity\GetActivitiesBySubSectorAction;
use App\Actions\Sector\GetSectorAction;
use App\Http\Controllers\Controller;

class SectorController extends Controller
{


    public function index(GetSectorAction $action)
    {
        return $action->execute();
    }

    public function show($id, GetActivitiesBySubSectorAction $action)
    {
        return $action->execute($id);
    }
}
