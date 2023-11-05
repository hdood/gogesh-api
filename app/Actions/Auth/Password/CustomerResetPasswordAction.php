<?php

namespace App\Actions\Auth\Password;

use App\Exceptions\CodeExpiredException;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Repository\Api\CustomerRepository;
use App\Repository\Api\ResetPasswordRepository;
use Illuminate\Support\Facades\Hash;

class CustomerResetPasswordAction
{
    public function __construct(private ResetPasswordRepository $passwordRepository, private CustomerRepository $customerRepository)
    {
    }

    public function execute(ResetPasswordRequest $request): void
    {

        $passwordReset = $this->passwordRepository->firstWhere(["code" => $request->code]);

        if ($passwordReset->isExpire()) {
            throw new CodeExpiredException();
        }

        $customer = $this->customerRepository->firstWhere(["email" => $passwordReset->email]);

        $customer->update(["password" => Hash::make($request->password)]);
    }
}
