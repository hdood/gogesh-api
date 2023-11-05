<?php

namespace App\Actions\CommercialActivity;

use Illuminate\Support\Arr;
use Illuminate\Http\JsonResponse;
use App\Repository\CommercialActivityRepository;
use App\Http\Resources\Api\CommercialActivity\CommercialActivityResource;
use Illuminate\Support\Facades\Auth;

class GetDetailsCommercialActivityAction
{

    public function __construct(private  readonly  CommercialActivityRepository $activityRepository)
    {
    }

    function execute(): CommercialActivityResource
    {

        return new CommercialActivityResource($this->activityRepository->getById(Auth::user()->commercialActivity->id));
    }
}
