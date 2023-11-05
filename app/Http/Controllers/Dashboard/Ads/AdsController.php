<?php

namespace App\Http\Controllers\Dashboard\Ads;

use App\Enum\EnumGeneral;
use Carbon\Carbon;
use App\Models\ReasonOffer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Ads\AdsRequest;
use App\Repository\Dashboard\Ads\AdsRepository;
use App\Repository\Dashboard\Categories\SectorRepository;
use App\Repository\Dashboard\Offer\ReasonRepository;
use App\Table\Ads\AdsTable;



class AdsController extends Controller
{
    private $ads;
    private $reason;
    private $sector;

    public function __construct(AdsRepository $ads, ReasonRepository $reason, SectorRepository $sector)
    {
        $this->ads = $ads;
        $this->reason = $reason;
        $this->sector = $sector;

        $this->middleware('permission:ads-list|ads-create|ads-edit|ads-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:ads-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ads-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ads-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(AdsTable $dataTable)
    {
        return $dataTable->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reason = ReasonOffer::all();
        $sector = $this->sector->all();
        return view('ads.action.create', compact('reason', 'sector'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdsRequest $request)
    {
        $data = $request->validated();
        if ($request->status == EnumGeneral::APPROVED) {
            $date_end = Carbon::parse($request->date_start)->addDays($request->duration);
            $data["date_end"] = $date_end;
        }
        data_set($data, 'images', saveImage('image', $request->images));
        $this->ads->create($data);
        return to_route('ads.index');
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
        $ads = $this->ads->getById($id);
        $reason = $this->reason->all();
        $sector = $this->sector->all();
        return view('ads.action.edit', compact('ads', 'reason', 'sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdsRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->has('images')) {
            data_set($data, 'images', saveImage('image', $request->images));
        }
        // return $request->validated();
        $data = $this->ads->update($id, $data);
        return to_route('ads.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->ads->getById($id)->delete();
    }
}
