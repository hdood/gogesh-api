<?php

namespace App\Actions\Auth;

use App\Exceptions\InvalidSocialiteProvider;
use App\Http\Requests\Api\Auth\SocialiteRequest;
use App\Http\Resources\SellerResource;
use App\Repository\Api\SellerRepository;
use Laravel\Socialite\Facades\Socialite;

class SellerSocialiteAction
{
    public function __construct(
        private readonly SellerRepository $sellerRepository,
    ) {
    }

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
            $createArray = [
                "firstname" => $providerUser->user['first_name'],
                "lastname" => $providerUser->user['last_name'],
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
        $seller = $this->sellerRepository->firstOrCreate([
            "email" => $providerUser->getEmail(),
        ], $createArray);
        if (!$seller->hasVerifiedEmail()) {
            $seller->markEmailAsVerified();
        }
        $seller->fcm_token = $request->fcm_token;
        $seller->save();
        $token =  $seller->createToken(env('SECRETE'))->plainTextToken;
        return ["seller" => new SellerResource($seller), "token" => $token];
    }

    protected function validateProvider($provider): void
    {
        if (!in_array($provider, ['google', 'facebook', 'apple'])) {
            throw new InvalidSocialiteProvider();
        }
    }
}
