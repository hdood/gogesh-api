<?php

namespace App\Actions\Ads;

use App\Http\Resources\Api\Ads\DetailsUpdateAdsResource;
use App\Repository\Api\AdsRepository;

class GetDetailsUpdateAdsAction
{
    public function __construct(private AdsRepository $adsRepository)
    {
    }


    public function execute($id): DetailsUpdateAdsResource
    {
        return new DetailsUpdateAdsResource($this->adsRepository->getById($id));
    }
}
