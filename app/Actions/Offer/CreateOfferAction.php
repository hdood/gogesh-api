<?php

namespace App\Actions\Offer;

use App\Enum\EnumGeneral;
use App\Exceptions\CommercialActivityRejectedException;
use App\Exceptions\CommercialActivityUnApprovedException;
use App\Http\Requests\Api\Offer\CreateOfferRequest;
use App\Http\Resources\CreatedOfferResource;
use App\Models\Seller;
use App\Repository\Dashboard\Offer\OfferRepository;
use Illuminate\Support\Facades\Auth;

class CreateOfferAction
{

    public function __construct(private readonly OfferRepository $offerRepository)
    {
    }

    /**
     * @throws CommercialActivityUnApprovedException
     * @throws CommercialActivityRejectedException
     */
    public function execute(CreateOfferRequest $offerRequest)
    {
        // return $offerRequest->validated();
        if (get_class(Auth::user()) == Seller::class) {
            $seller = Auth::user();
        } else {
            $seller = Auth::user()->seller;
        }

        $array = $offerRequest->validated();

        if ($seller->status == EnumGeneral::PENDING || $seller->upgraded_status == EnumGeneral::PENDING) {
            throw new CommercialActivityUnApprovedException();
        }
        if ($seller->status == EnumGeneral::REJECTED || $seller->upgraded_status == EnumGeneral::REJECTED || $seller->status == EnumGeneral::INACTIVE) {
            throw new CommercialActivityRejectedException();
        }

        if (!empty($offerRequest->video)) {
            $video = saveImage('video', $offerRequest->video);
            data_set($array, 'video', $video);
        }
        $paths = [];
        foreach ($offerRequest->images as $image) {
            $paths[] = saveImage("offer", $image);
        }
        // data_set($array, 'sector_id', $seller->sector_id);
        // data_set($array, 'activity_id', $seller->activity_id);
        // data_set($array, 'speciality_id', json_encode($seller->specialities));
        $offer = data_set($array, "images", json_encode($paths));
        $offer["seller_id"] = $seller->id;
        $offer = $this->offerRepository->createOffer($offer, $seller->id);
        // foreach ($array['specialities_id'] as $key => $value) {
        //     $offer->specialities()->create([
        //         'offer_id' => $offer->id,
        //         'speciality_id' => $value
        //     ]);
        // }
        return new CreatedOfferResource($offer);
    }
}
