<?php

namespace App\Repository;

use App\Models\Subscription;

class SubscriptionRepository
{


    function create($array)
    {
       return Subscription::create($array);
    }


    function update($array)
    {
        return Subscription::update($array);
    }


    function subscriptionByCommercialActivity($id)
    {
        return Subscription::where("seller_id",$id)->first();
    }

}
