<?php

namespace App\Actions\Auth\Password;

use App\Exceptions\CodeExpiredException;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Repository\Api\ResetPasswordRepository;
use App\Repository\Api\SellerRepository;
use Illuminate\Support\Facades\Hash;

class SellerResetPasswordAction
{

    public function __construct(private ResetPasswordRepository $passwordRepository, private SellerRepository $sellerRepository)
    {
    }

    public function execute(ResetPasswordRequest $request): void
    {

        $passwordReset = $this->passwordRepository->firstWhere(["code" => $request->code]);
        if ($passwordReset->isExpire()) {

            throw new CodeExpiredException();
        }
        $seller = $this->sellerRepository->firstWhere(["email" => $passwordReset->email]);

        $seller->update(["password" => Hash::make($request->password)]);
    }
}
