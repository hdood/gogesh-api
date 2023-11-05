<?php

namespace App\Http\Controllers\Dashboard\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Offer\ReasonRequest;
use App\Models\ReasonOffer;
use App\Repository\Dashboard\Offer\ReasonRepository;
use App\Table\Offer\ReasonTable;
use Illuminate\Http\Request;
use DataTables;

class ReasonController extends Controller
{
    private $reason;


    public function __construct(ReasonRepository $reason)
    {
        $this->reason = $reason;

        $this->middleware('permission:reason-list|reason-create|reason-edit|reason-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:reason-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:reason-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:reason-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ReasonTable $dataTable)
    {
        return $dataTable->render();
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reason.action.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReasonRequest $request)
    {
        $this->reason->create($request->validated());
        return to_route('offer.reason.index')->with('success', __('Added successfully to reason'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reason = $this->reason->getById($id);
        return view('reason.action.edit', compact('reason'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReasonRequest $request, string $id)
    {
        $this->reason->update($id, $request->validated());
        return to_route('offer.reason.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->reason->getById($id)->delete();
    }
}
