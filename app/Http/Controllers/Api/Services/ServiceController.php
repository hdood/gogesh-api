<?php

namespace App\Http\Controllers\Api\Services;

use App\Actions\Services\GetSectionsAction;
use App\Actions\Services\GetSectionsByIdAction;
use App\Actions\Services\GetServicesAction;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetServicesAction $action)
    {
        return $action->execute();
    }

    /**
     * Display the specified resource.
     */
    public function sections(GetSectionsAction $action)
    {
        return $action->execute();
    }

    public function show($id, GetSectionsByIdAction $action)
    {
        return $action->execute($id);
    }
}
