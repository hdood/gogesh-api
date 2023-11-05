<?php

namespace App\Actions\Ads;

use App\Models\AdsView;
use App\Models\OfferView;
use App\Repository\Dashboard\Ads\AdsRepository;
use Illuminate\Support\Facades\Auth;

class IncreaseAdsViewsAction
{

    public function __construct(private  AdsRepository $repository)
    {
    }


    public function execute($ads_id, $gust_id = null,): void
    {
        $customerId = Auth::guard("sanctum")->id();
        $query = AdsView::query();
        if ($gust_id) {
            $query->where("gust_id", $gust_id);
        }
        if ($customerId) {
            $query->where("customer_id", $customerId);
        }
        $query->where("ads_id", $ads_id);
        $view = $query->first();
        if (!$view) {
            $this->repository->addView([
                "ads_id" => $ads_id,
                "customer_id" => $customerId,
                "gust_id" => $gust_id
            ]);
        }
    }
}
