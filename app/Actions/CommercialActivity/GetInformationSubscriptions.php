<?php

namespace App\Actions\CommercialActivity;

use App\Exceptions\CommercialActivityNotSubscriptionException;
use App\Http\Resources\Api\subscription\SubscriptionResource;
use App\Repository\CommercialActivityRepository;
use Illuminate\Support\Facades\Auth;

class GetInformationSubscriptions
{

    public function __construct(private  readonly  CommercialActivityRepository $activityRepository)
    {
    }

    function execute()
    {
        if (Auth::user()->subscription) {
            return new SubscriptionResource(Auth::user()->subscription);
        }
        throw new CommercialActivityNotSubscriptionException();
    }
}
