<?php

namespace App\Actions\Ads;

use App\Http\Requests\Api\Ads\CreateAdsRequest;
use App\Http\Resources\Api\Ads\CreatedAdsResource;
use App\Repository\Dashboard\Ads\AdsRepository;
use Illuminate\Support\Facades\Auth;

class CreateAdsAction
{

    public function __construct(private AdsRepository $adsRepository)
    {
    }

    public function execute(CreateAdsRequest $adsRequest): CreatedAdsResource
    {
        $array = $adsRequest->validated();
        if (get_class(Auth::user()) == Seller::class) {
            $userId = Auth::id();
        } else {
            $userId = Auth::user()->commercialActivity->seller->id;
        }
        data_set($array, 'seller_id', $userId);
        return new CreatedAdsResource($this->adsRepository->create(data_set($array, "images", saveImage("ads", $adsRequest->images))));
    }
}
