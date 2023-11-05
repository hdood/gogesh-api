<?php

namespace App\Http\Controllers\Api\Specialization;

use App\Actions\Specializations\GetSpecializationsAction;
use App\Actions\Specializations\GetSpecializationsByActivityAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetSpecializationsAction $action)
    {
        return $action->execute();
    }

    public function show(int $id, GetSpecializationsByActivityAction $action)
    {
        return $action->execute($id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


}
