<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\CustomerLoginAction;
use App\Actions\Auth\Password\CheckResetPasswordCodeAction;
use App\Actions\Auth\Password\CustomerResetPasswordAction;
use App\Actions\Auth\Password\ForgotPasswordAction;
use App\Actions\Auth\Password\SellerResetPasswordAction;
use App\Actions\Auth\SellerLoginAction;
use App\Actions\Auth\UserCommercialLoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CheckCodeRequest;
use App\Http\Requests\Api\Auth\CustomerLoginRequest;
use App\Http\Requests\Api\Auth\ForgotPasswordCustomerRequest;
use App\Http\Requests\Api\Auth\ForgotPasswordSellerRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\SellerLoginRequest;
use App\Http\Requests\Api\Auth\UserCommercialLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function sellerLogin(
        SellerLoginRequest $request,
        SellerLoginAction  $action
    ): JsonResponse {

        $response = $action->execute($request);
        return new JsonResponse($response);
    }

    public function userCommecialLogin(
        UserCommercialLoginRequest $request,
        UserCommercialLoginAction  $action
    ): JsonResponse {

        $response = $action->execute($request);
        return new JsonResponse($response);
    }
    public function customerLogin(
        CustomerLoginRequest  $request,
        CustomerLoginAction $action
    ): JsonResponse {
        $response = $action->execute($request);
        return new JsonResponse($response);
    }


    public function forgotPasswordCustomer(
        ForgotPasswordCustomerRequest $request,
        ForgotPasswordAction $action
    ): JsonResponse {

        $action->execute($request);

        return new JsonResponse(['message' => __('passwords.sent')]);
    }

    public function forgotPasswordSeller(
        ForgotPasswordSellerRequest $request,
        ForgotPasswordAction $action
    ): JsonResponse {

        $action->execute($request);

        return new JsonResponse(['message' => __('passwords.sent')]);
    }

    public function checkCode(
        CheckCodeRequest $request,
        CheckResetPasswordCodeAction $action
    ): JsonResponse {

        $code =  $action->execute($request);

        return  new JsonResponse(['message' => __('passwords.code_is_valid'), 'code' => $code], 200);
    }

    public function sellerResetPassword(
        ResetPasswordRequest $request,
        SellerResetPasswordAction $action
    ): JsonResponse {

        $action->execute($request);

        return  new JsonResponse(['message' => __('passwords.reset')], 200);
    }

    public function customerResetPassword(
        ResetPasswordRequest $request,
        CustomerResetPasswordAction $action
    ): JsonResponse {

        $action->execute($request);

        return  new JsonResponse(['message' => __('passwords.reset')], 200);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return [
            'message' => 'user logged out'
        ];
    }
}
