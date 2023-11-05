<?php

namespace App\Actions\Auth;


use App\Exceptions\UnauthorizedException;
use App\Http\Requests\Api\Auth\SellerLoginRequest;
use App\Http\Resources\SellerResource;
use Illuminate\Support\Facades\Auth;

class SellerLoginAction
{

    public function __construct()
    {
    }


    public function execute(SellerLoginRequest $request): array
    {
        $attempt = Auth::guard("seller")->attempt($request->except('fcm_token'));
        if ($attempt) {
            $seller = Auth::guard("seller")->user();
            // Revoke all existing tokens for the seller
            $seller->tokens()->delete();
            $seller->fcm_token = $request->fcm_token;
            $seller->save();
            $token =  $seller->createToken(env('SECRETE'))->plainTextToken;
            return [
                "user" => new SellerResource($seller),
                "token" => $token
            ];
        }
        throw new UnauthorizedException();
    }
}
