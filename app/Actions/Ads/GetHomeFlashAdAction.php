<?php

namespace App\Actions\Ads;


use App\Http\Resources\Api\Ads\ShortInfoAdsResource;
use App\Repository\Dashboard\Ads\AdsRepository;

class GetHomeFlashAdAction
{

    public function __construct(private readonly AdsRepository $repository)
    {
    }

    public function execute(): ShortInfoAdsResource
    {
        $ad = $this->repository->getHomeFlashAd();
        return new ShortInfoAdsResource($ad);
    }

}
