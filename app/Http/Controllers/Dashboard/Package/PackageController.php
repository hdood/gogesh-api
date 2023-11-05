<?php

namespace App\Http\Controllers\Dashboard\Package;

use DataTables;
use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Package\PackageRequest;
use App\Repository\Dashboard\Package\PackageRepository;
use App\Table\Package\PackagesTable;

class PackageController extends Controller
{
    private $package;
    public function __construct(PackageRepository $package)
    {
        $this->package = $package;
        $this->middleware('permission:package-list|package-create|package-edit|package-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:package-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:package-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:package-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PackagesTable $dataTable)
    {
        return $dataTable->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('package.action.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $request)
    {
        $this->package->create($request->validated());
        return to_route('package.index');
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
        $package = $this->package->getById($id);
        return view('package.action.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageRequest $request, string $id)
    {
        $this->package->update($id, $request->validated());
        return to_route('package.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->package->getById($id)->delete();
    }
}
