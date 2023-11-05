<?php

declare(strict_types=1);

namespace App\Actions\Auth\Password;

use App\Exceptions\FailedSentPasswordResetLinkException;
use App\Http\Requests\ForgotPasswordRequest;
use App\Mail\SendCodeResetPassword;
use App\Repository\Api\ResetPasswordRepository;
use Exception;
use Illuminate\Support\Facades\Mail;

final class ForgotPasswordAction
{

    public function __construct(private ResetPasswordRepository $passwordRepository)
    {
    }

    public function execute($request): void
    {

        try {
            // Delete all old code that user send before.
            $this->passwordRepository->deleteByEmail($request->validated());
            // Generate random code
            $code = mt_rand(100000, 999999);

            // Create a new code
            $codeData = $this->passwordRepository->create(["code"=>$code,"email"=>$request->email]);

            // Send email to user
            Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));

        }catch (Exception $exception){
            throw new FailedSentPasswordResetLinkException();
        }

    }
}
