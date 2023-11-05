<?php

namespace App\Actions\Offer;

use App\Http\Resources\Api\Offer\ShortInfoOfferResource;
use App\Http\Resources\OfferDetailsResource;
use App\Jobs\AddOfferView;
use App\Repository\Dashboard\Offer\OfferRepository;
use Illuminate\Support\Facades\Request;

class GetCustomerOfferDetailsAction
{
    public function __construct(private readonly OfferRepository $repository )
    {
    }


    public function execute($id): array
    {
        $offer  = $this->repository->getOfferDetails($id);
        AddOfferView::dispatch($id,Request::query("gust_id"));
        return [
          "data" =>  new OfferDetailsResource($offer),
            "related_results" => ShortInfoOfferResource::collection($this->repository->getRelatedOffers($offer))
        ];
    }

}
