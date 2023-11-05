<?php

namespace App\Actions\Email;


use App\Exceptions\FailedToSendEmailVerificationCode;
use App\Mail\SendEmailVerificationCode;
use App\Models\EmailVerificationCode;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationCodeAction
{

    public function execute($email): void
    {
        try {

            EmailVerificationCode::where("email", $email)->delete();
            // Generate random code
            $code = mt_rand(100000, 999999);

            // Create a new code
            $codeData = EmailVerificationCode::create(["code" => $code, "email" => $email]);
            // Send email to user
            Mail::to($email)->send(new SendEmailVerificationCode($codeData->code));
        } catch (Exception $exception) {
            throw new FailedToSendEmailVerificationCode();
        }
    }
}
