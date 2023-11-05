<?php

namespace App\Actions\Ads;

use App\Http\Resources\Api\Ads\PaginateAdsResource;
use App\Repository\Dashboard\Ads\AdsRepository;
use Illuminate\Support\Facades\Request;

class GetAdsSellerAction
{

    public function __construct(private AdsRepository $adsRepository)
    {
    }

    public function execute(): PaginateAdsResource
    {
        $status = Request::query('status');
        return new PaginateAdsResource($this->adsRepository->getPaginatedAdsBySeller($status));
    }
}
