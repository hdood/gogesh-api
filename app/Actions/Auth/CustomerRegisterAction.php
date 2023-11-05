<?php

namespace App\Actions\Auth;

use App\Actions\Email\SendEmailVerificationCodeAction;
use App\Http\Requests\Api\Auth\CustomerRegisterRequest;
use App\Http\Resources\Api\customer\CustomerResource;
use App\Repository\Api\CustomerRepository;

class CustomerRegisterAction
{

    public function __construct(private readonly CustomerRepository $customerRepository, private readonly SendEmailVerificationCodeAction $sendEmailVerificationCodeAction)
    {
    }

    public function execute(CustomerRegisterRequest $request): array
    {
        $array = $request->validated();

        if ($request->hasFile('image')) {
            data_set($array, "image", saveImage("profile", $request->image));
        }
        $array['completed'] = 1;

        $customer = $this->customerRepository->create($array);

        $token =  $customer->createToken(env('SECRETE'))->plainTextToken;

        if (!$customer->hasVerifiedEmail()) {
            $customer->markEmailAsVerified();
        }
        return [
            "user" => new CustomerResource($customer),
            "token" => $token
        ];
    }
}
