<?php

namespace App\Actions\Auth\Password;

use App\Exceptions\CodeExpiredException;
use App\Http\Requests\Api\Auth\CheckCodeRequest;
use App\Repository\Api\ResetPasswordRepository;

class CheckResetPasswordCodeAction
{


    public function __construct(private ResetPasswordRepository $passwordRepository)
    {
    }

    public function execute(CheckCodeRequest $request): string
    {

        $passwordReset = $this->passwordRepository->firstWhere($request->validated());

        if ($passwordReset->isExpire()) {
            throw new CodeExpiredException();
        }

        return $passwordReset->code;

    }

}
