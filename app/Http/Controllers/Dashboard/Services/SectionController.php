<?php

namespace App\Http\Controllers\Dashboard\Services;

use App\Http\Controllers\Controller;
use App\Table\Services\SectionTable;
use App\Http\Requests\Dashboard\Services\SectionRequest;
use App\Repository\Dashboard\Services\SectionRepository;
use App\Repository\Dashboard\Services\ServiceRepository;

class SectionController extends Controller
{
    public function __construct(private ServiceRepository $service, private SectionRepository $section)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SectionTable $dataTable)
    {
        return $dataTable->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = $this->service->all();
        return view('services.section.action.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        $this->section->create($request->validated());
        return to_route('services.section.index');
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
        $services = $this->service->all();
        $section = $this->section->getById($id);
        return view('services.section.action.edit', compact('services', 'section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, string $id)
    {
        $this->section->update($id, $request->validated());
        return to_route('services.section.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
