<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\CustomerSocialiteAction;
use App\Actions\Auth\SellerSocialiteAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\SocialiteRequest;
use Illuminate\Http\JsonResponse;

class SocialiteController extends Controller
{


    public function sellerHandleProviderCallback(SocialiteRequest $request, SellerSocialiteAction $action): JsonResponse
    {
         $response =   $action->execute($request);
         return new JsonResponse($response);

    }

    public function customerHandleProviderCallback(SocialiteRequest $request, CustomerSocialiteAction $action): JsonResponse
    {
        $response =  $action->execute($request);
        return new JsonResponse($response);

    }


}
