<?php

namespace App\Actions\Ads;

use App\Http\Resources\Api\Ads\AdsDetailsResource;
use App\Jobs\AddAdsView;
use App\Repository\Dashboard\Ads\AdsRepository;
use Illuminate\Support\Facades\Request;

class GetDetailsAdsCustomerAction
{

    public function __construct(private AdsRepository $adsRepository)
    {
    }


    public function execute($id): AdsDetailsResource
    {
        AddAdsView::dispatch($id, Request::query("gust_id"));
        return new AdsDetailsResource($this->adsRepository->getByIdApproved($id));
    }
}
