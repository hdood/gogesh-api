<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Auth\Password\UpdatePasswordSellerAction;
use App\Actions\Auth\Password\UpdatePasswordCustomerAction;
use App\Http\Requests\Api\Auth\UpdatePasswordSellerRequest;
use App\Http\Requests\Api\Auth\UpdatePasswordCustomerRequest;

class UpdatePasswordController extends Controller
{


    public function sellerPassword(UpdatePasswordSellerRequest $request, UpdatePasswordSellerAction $action): JsonResponse
    {
        $response =   $action->execute($request);
        return  $response;
    }

    public function customerPassword(UpdatePasswordCustomerRequest $request, UpdatePasswordCustomerAction $action): JsonResponse
    {
        $response =  $action->execute($request);
        return $response;
    }
}
