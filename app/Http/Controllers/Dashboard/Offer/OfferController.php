<?php

namespace App\Http\Controllers\Dashboard\Offer;


use App\Models\Season;
use App\Models\Sector;
use App\Models\Seller;

use App\Enum\EnumGeneral;
use App\Models\ReasonOffer;
use Illuminate\Support\Arr;
use App\Models\UpdatedOffer;
use Illuminate\Http\Request;
use App\Models\DurationOffer;
use App\Table\Offer\OfferTable;
use App\Http\Controllers\Controller;
use App\Repository\SubscriptionRepository;
use App\Http\Requests\Dashboard\Offer\OfferRequest;
use App\Models\Subscription;
use App\Repository\Dashboard\Offer\OfferRepository;

class OfferController extends Controller
{

    public function __construct(private OfferRepository $offer, private readonly SubscriptionRepository $repository)
    {
        $this->middleware('permission:offer-list|offer-create|offer-edit|offer-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:offer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:offer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:offer-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(OfferTable $dataTable)
    {
        return $dataTable->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $offer = $this->offer->getById($id);


        $sectors = Sector::all();
        $season = Season::all();
        $duration = DurationOffer::all();
        $reason = ReasonOffer::all();
        $seller = Seller::all();
        $offerUpdate = $offer->updatedOffer;
        try {
            if ($offerUpdate->rejected == 1) {
                $offerUpdate = null;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return view('offer.action.edit', compact('offer', 'offerUpdate', 'sectors', 'season', 'duration', 'reason', 'seller'));
    }
    public function approvedUpdate(string $id)
    {
        $offer = $this->offer->getById($id);
        $offerUpdate = $offer->updatedOffer;

        $array = Arr::except(json_decode($offerUpdate, true), ['id', 'offer_id']);

        $data = array_filter($array, function ($value) {
            return $value !== null && $value !== "";
        });
        $this->offer->changeDataOffer($id, $data);
        $offerUpdate->delete();
        $offer->status = EnumGeneral::APPROVED;
        $offer->updated_id = null;
        $offer->save();
        return to_route('offer.index');
    }
    public function rejectedUpdate(string $id, Request $request)
    {
        $updatedOffer = UpdatedOffer::findOrfail($id);
        $updatedOffer->rejected = 1;
        $updatedOffer->reason_id = $request->reason_id;
        $updatedOffer->save();
        $updatedOffer->offer->status = $updatedOffer->offer->old_status;
        $updatedOffer->offer->save();
        if ($updatedOffer->offer->old_status == EnumGeneral::APPROVED) {
            $subscription = Subscription::where("commercial_activity_id", $updatedOffer->offer->commercialActivity->id)->first();
            $subscription->max_offer_change += 1;
            $subscription->save();
        }

        return to_route('offer.index');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(OfferRequest $request, string $id)
    {

        // return $request->validated();
        $this->offer->update($id, $request->validated());
        return to_route('offer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->offer->getById($id)->delete();
    }
}
