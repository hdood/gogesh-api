<?php

namespace App\Actions\Ads;

use App\Http\Resources\Api\Ads\AdsDetailsResource;
use App\Repository\Dashboard\Ads\AdsRepository;


class GetDetailsAdsSellerAction
{

    public function __construct(private AdsRepository $adsRepository)
    {
    }


    public function execute($id): AdsDetailsResource
    {
        return new AdsDetailsResource($this->adsRepository->getById($id));
    }
}
