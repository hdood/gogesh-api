<?php

namespace App\Repository;

use App\Models\Order;

class CustomerOffersRepository
{


    public function create($offerId,$customerId)
    {
        return Order::create(["offer_id"=>$offerId,"customer_id" => $customerId]);
    }
}
