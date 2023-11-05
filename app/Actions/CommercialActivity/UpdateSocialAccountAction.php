<?php

namespace App\Actions\CommercialActivity;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\Company\UpdateSocialAccountRequest;
use App\Repository\Api\SellerRepository;

class UpdateSocialAccountAction
{

    public function __construct(private  readonly  SellerRepository $sellerRepository)
    {
    }

    function execute($id, UpdateSocialAccountRequest $request): JsonResponse
    {
        $array = $request->validated();


        if ($request->has('social_accounts')) {
            data_set($array, "social_accounts", json_encode($array["social_accounts"]));
        }

        $this->sellerRepository->update(
            $id,
            $array
        );

        return response()->json('success');
    }
}
