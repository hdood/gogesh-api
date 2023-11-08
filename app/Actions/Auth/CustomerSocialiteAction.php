<?php

namespace App\Actions\Auth;

use App\Exceptions\InvalidSocialiteProvider;
use App\Http\Requests\Api\Auth\SocialiteRequest;
use App\Http\Resources\Api\customer\CustomerResource;
use App\Repository\Api\CustomerRepository;
use Laravel\Socialite\Facades\Socialite;

class CustomerSocialiteAction
{

    public function __construct(
        private CustomerRepository $customerRepository,
    ) {
    }

    /**
     * @throws InvalidSocialiteProvider
     */
    public function execute(SocialiteRequest $request): array
    {

        $provider = $request->provider;
        $this->validateProvider($provider);

        $providerUser = Socialite::driver($provider)->userFromToken($request->access_provider_token);
        $createArray = [];
        if ($provider == "google") {
            $createArray = [
                "firstname" => $providerUser->user['given_name'],
                "lastname" => $providerUser->user['family_name'],
                "image" => $providerUser->avatar,
                "completed" => 0,
                "fcm_token" => $request->fcm_token
            ];
        }

        if ($provider == "facebook") {
            $names = explode(' ', $providerUser->name);
            $firstName = $names[0];
            $lastName = count($names) > 1 ? end($names) : ' ';
            $createArray = [
                "firstname" => $firstName,
                "lastname" => $lastName,
                "image" => $providerUser->avatar,
                "completed" => 0,
                "fcm_token" => $request->fcm_token

            ];
        }
        if ($provider == "apple") {
            $names = explode(' ', $providerUser->name);
            $firstName = $names[0];
            $lastName = count($names) > 1 ? end($names) : ' ';
            $createArray = [
                "firstname" => $firstName,
                "lastname" => $lastName,
                "completed" => 0,
                "fcm_token" => $request->fcm_token
            ];
        }


        $customer = $this->customerRepository->firstOrCreate([
            "email" => $providerUser->getEmail(),
        ], $createArray);

        if (!$customer->hasVerifiedEmail()) {
            $customer->markEmailAsVerified();
        }

        $customer->fcm_token = $request->fcm_token;
        $customer->save();
        $token =  $customer->createToken(env('SECRET'))->plainTextToken;
        return [
            "customer"  => new CustomerResource($customer),
            "token" => $token
        ];
    }

    protected function validateProvider($provider): void
    {
        if (!in_array($provider, ['google', 'facebook', 'apple',])) {
            throw new InvalidSocialiteProvider();
        }
    }
}
