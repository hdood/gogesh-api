<?php

namespace App\Actions\Ads;


use App\Http\Resources\Api\Ads\PaginateAdsResource;
use App\Repository\Dashboard\Ads\AdsRepository;
use Illuminate\Support\Facades\Request;

class GetSectorBannerAdsAction
{

    public function __construct(private readonly  AdsRepository $repostory)
    {
    }

    public function execute():PaginateAdsResource
    {
       return new PaginateAdsResource($this->repostory->getSectorBannerAds(Request::query("sector")));
    }

}
