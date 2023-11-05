<?php

namespace App\Actions\Offer;


use App\Http\Requests\Api\Offer\UpdateOfferRequest;
use App\Repository\Dashboard\Offer\OfferRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateOfferAction
{

    public function __construct(private    OfferRepository $repository)
    {
    }

    public function execute(UpdateOfferRequest $request, $id): JsonResponse
    {
        $array = $request->validated();

        $oldOffer = $this->repository->getById($id);
        /// case one: images_paths is null , it means the user change all images
        /// case three: images_paths and images are not null
        $paths = [];
        if (!empty($request->images) && !empty($request->images_paths)) {
            /// save new images
            foreach ($request->images as $image) {
                $paths[] = saveImage("offer", $image);
            }
            /// merge new images with olds

            data_set($array, "images", json_encode(array_merge($paths, $request->images_paths)));
        } elseif (empty($request->images_paths)) {
            foreach ($request->images as $image) {
                $paths[] = saveImage("offer", $image);
            }
            data_set($array, "images", json_encode($paths));
            /// delete old images.
            foreach (json_decode($oldOffer->images) as $path) {
                if (file_exists(public_path($path)))
                    unlink(public_path($path));
            }
        } elseif (empty($request->images)) {
            /// case tow: images is null , means the user not changed the images
            data_set($array, "images", json_encode($array["images_paths"]));
        }



        if (!empty($request->video) && !empty($request->video_path)) {
            /// save new video
            data_set($array, "video", saveImage("video", $request->video));
        } elseif (!empty($request->video)) {
            /// save new video
            data_set($array, "video", saveImage("video", $request->video));
        } elseif (!empty($request->video_path)) {
            /// save new video
            data_set($array, "video", $request->video_path);
        }

        // data_set($array, 'sector_id', $commercialActivity->sector_id);
        // data_set($array, 'activity_id', $commercialActivity->activity_id);
        // data_set($array, 'speciality_id', $commercialActivity->specialization_id);
        $this->repository->checkAndDelete($id);
        $this->repository->updateOfferApi($oldOffer->id, $array);

        return new JsonResponse(["message" => __("offers.offer_updated_successfully")]);
    }
}
