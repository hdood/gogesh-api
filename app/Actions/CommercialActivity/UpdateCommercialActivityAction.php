<?php

namespace App\Actions\CommercialActivity;

use Illuminate\Http\JsonResponse;
use App\Repository\CommercialActivityRepository;
use App\Http\Requests\Api\Company\UpdateCommercialActivityRequest;

class UpdateCommercialActivityAction
{

    public function __construct(private  readonly  CommercialActivityRepository $activityRepository)
    {
    }

    function execute($id, UpdateCommercialActivityRequest $request): JsonResponse
    {
        $array = $request->validated();
        $oldCommercial = $this->activityRepository->getById($id);
        if (!empty($request->logo_path)) {
            data_set($array, "logo", $request->logo_path);
            /// delete old images.
            // if (file_exists(public_path($oldCommercial->logo)))
            //     unlink(public_path($oldCommercial->logo));
        }

        if (!empty($request->commercial_register_path)) {
            data_set($array, "commercial_register", $request->commercial_register_path);
            /// delete old images.
            // if (file_exists(public_path($oldCommercial->commercial_register)))
            //     unlink(public_path($oldCommercial->commercial_register));
        }

        if (!empty($request->commercial_signature_path)) {
            data_set($array, "commercial_signature", $request->commercial_signature_path);
            /// delete old images.
            // if (file_exists(public_path($oldCommercial->commercial_signature)))
            //     unlink(public_path($oldCommercial->commercial_signature));
        }

        if ($request->hasFile('logo')) {
            data_set($array, "logo", saveImage("logos", $request->logo));
        }
        if ($request->hasFile('commercial_register')) {
            data_set($array, "commercial_register", saveImage("docs", $request->commercial_register));
        }
        if ($request->hasFile('commercial_signature')) {
            data_set($array, "commercial_signature", saveImage("docs", $request->commercial_signature));
        }


        if ($request->has('seasons')) {
            data_set($array, "seasons", json_encode($request->seasons));
        }
        data_set($array, "commercial_activity_id", $id);

        $this->activityRepository->checkAndDelete($id);

        $commercialActivity = $this->activityRepository->update(
            $array
        );

        return response()->json('success');
    }
}
