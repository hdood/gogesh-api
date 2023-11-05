<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\CustomerRegisterAction;
use App\Actions\Auth\SellerRegisterAction;
use App\Actions\Auth\UserCommercialRegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CustomerRegisterRequest;
use App\Http\Requests\Api\Auth\SellerRegisterRequest;
use App\Http\Requests\Api\Auth\UserCommercialRegisterRequest;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{





    public function sellerRegister(
        SellerRegisterRequest $request,
        SellerRegisterAction  $action
    ): JsonResponse

    {

        $response =  $action->execute($request);
        return new JsonResponse($response);

    }

    public function userCommercialRegister(
        UserCommercialRegisterRequest $request,
        UserCommercialRegisterAction  $action
    ): JsonResponse

    {

        $response =  $action->execute($request);
        return new JsonResponse($response);

    }

    public function customerRegister(
        CustomerRegisterRequest $request,
        CustomerRegisterAction  $action
    ): JsonResponse

    {

        $response = $action->execute($request);

        return new JsonResponse($response);



    }
}
