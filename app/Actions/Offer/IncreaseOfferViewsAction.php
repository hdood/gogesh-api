<?php

namespace App\Actions\Offer;

use App\Models\OfferView;
use App\Repository\OfferViewsRepository;
use Illuminate\Support\Facades\Auth;

class IncreaseOfferViewsAction
{

    public function __construct(private readonly OfferViewsRepository $repository)
    {
    }


    public function execute($offer_id,$gust_id = null,): void
    {
        $customerId = Auth::id();
        $query = OfferView::query();
        if ($gust_id){
            $query->where("gust_id",$gust_id);
        }
        if ($customerId){
            $query->where("customer_id",$customerId);
        }
        $query->where("offer_id",$offer_id);
        $view = $query->first();
        if(!$view){
            $this->repository->create([
                "offer_id" => $offer_id,
                "customer_id" => $customerId,
                "gust_id" => $gust_id
            ]);
        }

    }

}
