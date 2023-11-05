<?php

namespace App\Http\Controllers\Api\Package;

use App\Actions\Package\GetPackageAction;
use DataTables;
use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Package\PackageRequest;
use App\Repository\Dashboard\Package\PackageRepository;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetPackageAction $action)
    {
        return $action->execute();
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
    }
}
