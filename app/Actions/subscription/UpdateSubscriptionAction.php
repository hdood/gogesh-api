<?php

namespace App\Actions\subscription;

use App\Http\Resources\Api\subscription\SubscriptionResource;
use App\Jobs\SaveNotification;
use App\Jobs\SendNotificationSeller;
use App\Models\Seller;
use App\Models\Subscription;
use App\Repository\Dashboard\Package\PackageRepository;
use App\Repository\SubscriptionRepository;

class UpdateSubscriptionAction
{

    public function __construct(private readonly SubscriptionRepository $repository, private readonly PackageRepository $packageRepository)
    {
    }

    public function execute($request)
    {
        //          $currentSubscription = Auth::guard("sanctum")->user()->commercialActivity->subscription;
        $id = $request['id'];
        $package_id = $request['package_id'];
        $seller = Seller::findOrfail($request['id']);
        $currentSubscription = $this->repository->subscriptionByCommercialActivity($id); // get current subscription

        $package = $this->packageRepository->getById($package_id); // get new package
        // return $package;

        if ($currentSubscription) {
            $attributesToAdd = [
                'max_offers',
                'max_offer_change',
                'max_specialties',
                'max_ads_per_notification',
                'max_free_ads',
                'max_users',
                'duration',
                'max_ads_via_sector_banner',
            ];
            foreach ($attributesToAdd as $attribute) {
                $currentSubscription->$attribute += $package->$attribute;
            }

            $currentSubscription->name_ar = $package->name_ar;
            $currentSubscription->name_en = $package->name_en;
            $currentSubscription->price = $package->price;
            $currentSubscription->ads_discount = $package->ads_discount;
            $currentSubscription->features_ar = $package->features_ar;
            $currentSubscription->features = $package->features;
            $currentSubscription->free_ads_duration = $package->free_ads_duration;
            $currentSubscription->offer_change_cost = $package->offer_change_cost;
            $currentSubscription->offer_addition_cost = $package->offer_addition_cost;
            $currentSubscription->specialty_addition_cost = $package->specialty_addition_cost;
            $currentSubscription->ads_via_sectors_banner_duration = $package->ads_via_sectors_banner_duration;
            $currentSubscription->save();
        } else {

            $packageData = $package->toArray();

            unset($packageData['status']);

            $packageData['seller_id'] = $id;
            $currentSubscription =  Subscription::create($packageData);
        }
        // send notification to seller
        SendNotificationSeller::dispatch('Subscription', 'Now you have a subscription to a package', $seller->fcm_token);
        $data = [
            "title" => 'Subscription',
            "title_ar" => 'اشتراك',
            "content" => 'Now you have a subscription to a package',
            "content_ar" => "الأن أنت لديك اشتراك في باقة",
            "type" => "success",
            "receive_id" => $seller->id,
            "type_receive" => Seller::class,
        ];
        SaveNotification::dispatch($data);

        return new SubscriptionResource($currentSubscription);
    }
}
