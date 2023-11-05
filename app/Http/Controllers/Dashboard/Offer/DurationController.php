<?php

namespace App\Http\Controllers\Dashboard\Offer;

use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Offer\DurationRequest;
use App\Repository\Dashboard\Offer\DurationRepository;
use App\Table\Offer\DurationTable;
use DataTables;

class DurationController extends Controller
{
    private $duration;


    public function __construct(DurationRepository $duration)
    {
        $this->duration = $duration;

        $this->middleware('permission:duration-list|duration-create|duration-edit|duration-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:duration-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:duration-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:duration-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(DurationTable $dataTable)
    {
        return $dataTable->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('duration.action.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DurationRequest $request)
    {
        $this->duration->create($request->validated());
        return to_route('offer.duration.index');
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
        $duration = $this->duration->getById($id);
        return view('duration.action.edit', compact('duration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DurationRequest $request, string $id)
    {
        $this->duration->update($id, $request->validated());
        return to_route('offer.duration.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->duration->getById($id)->delete();
    }
}
