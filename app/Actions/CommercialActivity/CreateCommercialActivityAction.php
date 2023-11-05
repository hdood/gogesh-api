<?php

namespace App\Actions\CommercialActivity;

use App\Http\Requests\Api\Company\CreateCommercialActivityRequest;
use App\Http\Resources\CommercialActivityResource;
use App\Repository\CommercialActivityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class CreateCommercialActivityAction
{

    public function __construct(private  readonly  CommercialActivityRepository $activityRepository)
    {
    }

    function execute(CreateCommercialActivityRequest $request):JsonResponse
    {
         $array = $request->validated();

        if ($request->hasFile('logo')) {
            data_set($array,"logo",saveImage("logos",$request->logo));
        }
        if ($request->hasFile('commercial_register')) {
            data_set($array,"commercial_register",saveImage("docs",$request->commercial_register));
        }
        if ($request->hasFile('commercial_signature')) {
            data_set($array,"commercial_signature",saveImage("docs",$request->commercial_signature));
        }



        data_set($array,"social_accounts",json_encode($array["social_accounts"]));
        data_set($array,"work_days",json_encode($array["work_days"]));


        $commercialActivity = $this->activityRepository->create(
            Arr::except($array,["seasons"])

        );
        $commercialActivity->seasons()->sync($array["seasons"]);

        return new JsonResponse([
            "message"=>__("commercial_activity.commercial_activity_created_successfully"),
            "data" => new CommercialActivityResource($commercialActivity,)
        ],);
    }

}
