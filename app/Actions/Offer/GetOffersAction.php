<?php

namespace App\Actions\Offer;

use App\Repository\Dashboard\Offer\OfferRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class GetOffersAction
{

    public function __construct(private OfferRepository $offerRepository, private GetOffersMostRequestAction $action)
    {
    }


    public function execute(Request $request): LengthAwarePaginator
    {
        $service = $request->query("service");
        $section = $request->query("section");
        $activity = $request->query("activity");
        $speciality = $request->query("speciality");
        $companyType = $request->query("service_type");
        $season = $request->query("season");
        $type = $request->query("type");
        $select = $request->query("select");
        $sort = $request->query("sort");
        return $this->offerRepository->filterOffers($service, $section, $activity, $speciality, $companyType, $season, $type, $select, $sort);
    }
}
