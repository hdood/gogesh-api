<?php

namespace App\Actions\Auth;

use App\Http\Requests\Api\Auth\SellerComplateRegisterRequest;

use App\Http\Resources\Api\Seller\SellerResource;
use App\Repository\Api\SellerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CompletedRegisterSellerAction
{


    public function __construct(private SellerRepository $repository)
    {
    }

    public function execute(SellerComplateRegisterRequest $request)
    {
        $array = $request->validated();
        $array['completed'] = 1;
        if ($request->hasFile('image')) {
            data_set($array, "image", saveImage("profile", $request->image));
        }

        if ($request->hasFile('civil_card')) {
            data_set($array, "civil_card", saveImage("document", $request->civil_card));
        }

        if ($request->hasFile('commercial_license')) {
            data_set($array, "commercial_license", saveImage("document", $request->civil_card));
        }

        if ($request->hasFile('signature_approval')) {
            data_set($array, "signature_approval", saveImage("document", $request->civil_card));
        }

        $seller = $this->repository->update(Auth::id(), $array);
        if (!empty($request->sections_id)) {
            foreach ($array['sections_id'] as $key => $value) {
                $seller->sections()->create([
                    'seller_id' => $seller->id,
                    'section_id' => $value
                ]);
            }
        }
        if (!empty($request->services_id)) {
            foreach ($array['services_id'] as $key => $value) {
                $seller->services()->create([
                    'seller_id' => $seller->id,
                    'service_id' => $value
                ]);
            }
        }


        return new JsonResponse(["seller" => new SellerResource($this->repository->getById(Auth::id()))]);
    }
}
