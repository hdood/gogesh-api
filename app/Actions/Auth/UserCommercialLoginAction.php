<?php

namespace App\Actions\Auth;


use App\Exceptions\UnauthorizedException;
use App\Http\Requests\Api\Auth\UserCommercialLoginRequest;
use App\Http\Resources\Api\customer\UserCommercialResource;
use Illuminate\Support\Facades\Auth;

class UserCommercialLoginAction
{

    public function __construct()
    {
    }


    public function execute(UserCommercialLoginRequest $request): array
    {
        $attempt = Auth::guard("userCommercial")->attempt($request->except('fcm_token'));
        if ($attempt) {
            $user = Auth::guard("userCommercial")->user();
            $user->tokens()->delete();
            $user->fcm_token = $request->fcm_token;
            $user->save();
            $token =  $user->createToken(env('SECRET'))->plainTextToken;
            return [
                "user" => new UserCommercialResource($user),
                "token" => $token
            ];
        }
        throw new UnauthorizedException();
    }
}
