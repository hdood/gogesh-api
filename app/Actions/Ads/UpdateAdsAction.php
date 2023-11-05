<?php

namespace App\Actions\Ads;

use App\Enum\EnumGeneral;
use App\Http\Requests\Api\Ads\UpdateAdsRequest;
use App\Repository\Api\AdsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateAdsAction
{

    public function __construct(private AdsRepository $repository)
    {
    }

    public function execute(UpdateAdsRequest $request, $id): JsonResponse
    {
        $array = $request->validated();

        $oldOAds = $this->repository->getById($id);
        /// case three: images_paths and images are not null
        if ($oldOAds->status != EnumGeneral::APPROVED) {
            if (!empty($request->images) && !empty($request->images_path)) {
                /// save new images
                data_set($array, "images", saveImage("images", $request->images));
            } elseif (!empty($request->images)) {
                /// save new images
                data_set($array, "images", saveImage("images", $request->images));
            } elseif (!empty($request->images_path)) {
                /// save new images
                data_set($array, "images", $request->images_path);
            }
            data_set($array, "status", EnumGeneral::PENDING);
            $this->repository->update($oldOAds->id, $array);

            return new JsonResponse(["message" => __("offers.offer_updated_successfully")]);
        }
        return new JsonResponse(["message" => __("offers.offer_can_not_updated")]);
    }
}
