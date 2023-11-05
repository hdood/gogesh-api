<?php

namespace App\Http\Controllers\Dashboard\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Table\Services\ServicesTable;
use App\Http\Requests\Dashboard\Services\ServiceRequest;
use App\Repository\Dashboard\Services\ServiceRepository;

class ServiceController extends Controller
{
    public function __construct(private ServiceRepository $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ServicesTable $dataTable)
    {
        return $dataTable->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.service.action.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $this->service->create($request->validated());
        return to_route('services.service.index');
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
        $service = $this->service->getById($id);
        return view('services.service.action.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, string $id)
    {
        $this->service->update($id, $request->validated());
        return to_route('services.service.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
