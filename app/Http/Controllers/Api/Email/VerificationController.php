<?php

namespace App\Http\Controllers\Api\Email;

use App\Actions\Email\CustomerEmailVerificationAction;
use App\Actions\Email\EmailVerificationAction;
use App\Actions\Email\SellerEmailVerificationAction;
use App\Actions\Email\SendEmailVerificationCodeAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailVerfication\EmailVerificationRequest;
use App\Http\Requests\EmailVerfication\ResendEmailVerificationCodeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verifyEmail(
        EmailVerificationRequest $request,
        EmailVerificationAction $action,
    ): JsonResponse {


        $action->execute($request);

        return new JsonResponse([
            "message" => __('register.user_successfully_verified')
        ]);
    }

    public function resendVerificationCode(
        ResendEmailVerificationCodeRequest $request,
        SendEmailVerificationCodeAction $action,
    ): JsonResponse {


        $action->execute($request->email);

        return new JsonResponse([
            "message" => __('email.verification_code_was_sent')
        ]);
    }
}
