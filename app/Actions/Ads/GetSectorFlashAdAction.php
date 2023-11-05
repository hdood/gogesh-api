<?php

namespace App\Actions\Ads;


use App\Http\Resources\Api\Ads\ShortInfoAdsResource;
use App\Repository\Dashboard\Ads\AdsRepository;
use Illuminate\Support\Facades\Request;

class GetSectorFlashAdAction
{

    public function __construct(private readonly AdsRepository $repository)
    {
    }

    public function execute(): ShortInfoAdsResource
    {
        return new ShortInfoAdsResource($this->repository->getSectorFlashAd(Request::query("sector")));
    }

}
