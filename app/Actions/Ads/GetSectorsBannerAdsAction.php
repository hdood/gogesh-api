<?php

namespace App\Actions\Ads;


use App\Http\Resources\Api\Ads\PaginateAdsResource;
use App\Repository\Dashboard\Ads\AdsRepository;

class GetSectorsBannerAdsAction
{

    public function __construct(private  readonly  AdsRepository $repository)
    {
    }

    public function execute():PaginateAdsResource
    {
         return  new PaginateAdsResource($this->repository->getSectorsBannerAds());
    }

}
