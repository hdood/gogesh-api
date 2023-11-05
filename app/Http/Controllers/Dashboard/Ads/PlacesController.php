<?php

namespace App\Http\Controllers\Dashboard\Ads;

use DataTables;
use Carbon\Carbon;
use App\Models\Sector;
use App\Enum\EnumGeneral;
use App\Models\ReasonOffer;
use App\Table\Ads\AdsTable;
use Illuminate\Http\Request;
use App\Table\Ads\PlacesAdsTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\Ads\AdsRequest;
use App\Http\Requests\Dashboard\Ads\PlaceAdsRequest;
use App\Models\PlacesAds;
use App\Repository\Dashboard\Ads\AdsRepository;
use App\Repository\Dashboard\Offer\ReasonRepository;
use App\Repository\Dashboard\Categories\SectorRepository;

class PlacesController extends Controller
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
    public function index(PlacesAdsTable $dataTable)
    {
        return $dataTable->render();
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
        $place = PlacesAds::findOrfail($id);
        return view('ads.places.partials.body', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlaceAdsRequest $request, string $id)
    {
        $data = $request->validated();
        $place = PlacesAds::findOrfail($id);
        $place->update($data);
        if ($request->status == EnumGeneral::ACTIVE) {
            $stat = '<span class="badge rounded-pill bg-success text-light">' . __($request->status) . '</span>';
        } elseif ($request->status == EnumGeneral::INACTIVE) {
            $stat = '<span class="badge rounded-pill bg-danger text-light ">' . __($request->status) . '</span>';
        }
        return response()->json([
            'success' => __('updated_places'),
            'status' => $stat
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->ads->getById($id)->delete();
    }
}
