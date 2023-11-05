<?php

namespace App\Actions\Ads;

use App\Enum\EnumGeneral;
use App\Models\PlacesAds;
use App\Http\Resources\Api\Ads\PlacesAdsResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GetPlacesAdsAction
{

    public function __construct()
    {
    }

    public function execute(): ResourceCollection
    {
        $places = PlacesAds::where('status', EnumGeneral::ACTIVE)->get();
        return PlacesAdsResource::collection($places);
    }
}
