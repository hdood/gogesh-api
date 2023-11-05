<?php

namespace App\Actions\Auth;

use App\Exceptions\UnauthorizedException;
use App\Http\Requests\Api\Auth\CustomerLoginRequest;
use App\Http\Resources\Api\customer\CustomerResource;
use Illuminate\Support\Facades\Auth;

class CustomerLoginAction
{
    /**
     * @throws UnauthorizedException
     */
    public function execute(CustomerLoginRequest $request): array
    {
        $attempt = Auth::guard("customer")->attempt($request->except('fcm_token'));
        if ($attempt) {
            $customer = Auth::guard("customer")->user();
            // Revoke all existing tokens for the seller
            $customer->tokens()->delete();
            $customer->fcm_token = $request->fcm_token;
            $customer->save();
            $token =  $customer->createToken(env('SECRETE'))->plainTextToken;
            return [
                "user" => new CustomerResource($customer),
                "token" => $token
            ];
        }
        throw new UnauthorizedException();
    }
}
