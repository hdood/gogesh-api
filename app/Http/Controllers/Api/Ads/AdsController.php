<?php

namespace App\Http\Controllers\Api\Ads;

use App\Actions\Ads\CreateAdsAction;
use App\Actions\Ads\GetAdsCustomerAction;
use App\Actions\Ads\GetAdsSellerAction;
use App\Actions\Ads\GetDetailsAdsCustomerAction;
use App\Actions\Ads\GetDetailsAdsSellerAction;
use App\Actions\Ads\GetDetailsUpdateAdsAction;
use App\Actions\Ads\GetHomeBannerAdsAction;
use App\Actions\Ads\GetHomeFlashAdAction;
use App\Actions\Ads\GetSearchBannerAdsAction;
use App\Actions\Ads\GetSectorBannerAdsAction;
use App\Actions\Ads\GetSectorFlashAdAction;
use App\Actions\Ads\GetSectorsBannerAdsAction;
use App\Actions\Ads\UpdateAdsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ads\CreateAdsRequest;
use App\Http\Requests\Api\Ads\UpdateAdsRequest;
use App\Http\Resources\Api\Ads\PaginateAdsResource;
use App\Http\Resources\Api\Ads\ShortInfoAdsResource;
use App\Models\Ads;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexCustomer(GetAdsCustomerAction $action)
    {
        return $action->execute();
    }

    public function index(GetAdsSellerAction $action)
    {
        return $action->execute();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAdsRequest $request, CreateAdsAction $action)
    {
        //        return $request->validated();
        return $action->execute($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, GetDetailsAdsSellerAction $action)
    {
        return $action->execute($id);
    }

    public function edit($id, GetDetailsUpdateAdsAction $action)
    {
        return $action->execute($id);
    }
    public function showCustomer(string $id, GetDetailsAdsCustomerAction $action)
    {
        return $action->execute($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdsRequest $request, string $id, UpdateAdsAction $action)
    {
        return $action->execute($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ads::findOrfail($id)->delete();
        return response()->json(['Success' => 'The ad is delete']);
    }

    public function getHomeBannerAds(GetHomeBannerAdsAction $action): PaginateAdsResource
    {
        return $action->execute();
    }

    public function getHomeFlashAd(GetHomeFlashAdAction $action): ShortInfoAdsResource
    {
        return $action->execute();
    }

    public function getSectorsBannerAds(GetSectorsBannerAdsAction $action): PaginateAdsResource
    {
        return $action->execute();
    }

    public function getSectorBannerAds(GetSectorBannerAdsAction $action): PaginateAdsResource
    {
        return $action->execute();
    }

    public function getSectorFlashAd(GetSectorFlashAdAction $action): ShortInfoAdsResource
    {
        return $action->execute();
    }

    public function getSearchBannerAds(GetSearchBannerAdsAction $action): PaginateAdsResource
    {
        return $action->execute();
    }
}
