<?php

namespace App\Http\Controllers\Api\SubSector;

use App\Actions\Activity\GetActivitiesBySubSectorAction;
use App\Actions\SubSector\GetSubSectorsAction;
use App\Http\Controllers\Controller;

class SubSectorController extends Controller
{


    public function index(GetSubSectorsAction $action)
    {
        return $action->execute();
    }

    public function show($id, GetActivitiesBySubSectorAction $action)
    {
        return $action->execute($id);
    }
}
