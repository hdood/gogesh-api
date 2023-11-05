<?php

namespace App\Actions\Ads;

use App\Http\Resources\Api\Ads\PaginateAdsResource;
use App\Repository\Dashboard\Ads\AdsRepository;
use App\Repository\PollRepository;
use Illuminate\Support\Facades\Request;

class GetAdsCustomerAction
{

    public function __construct(private AdsRepository $adsRepository)
    {
    }

    public function execute(): PaginateAdsResource
    {
        $type = Request::query('service_type');
        return new PaginateAdsResource($this->adsRepository->getPaginatedAds(type: $type,));
        // return $this->adsRepository->getPaginatedAds(type: $type, place: $place, sector: $sector);

    }
}
