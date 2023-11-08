<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Repository\Api\UserCommercialRepository;
use App\Http\Requests\Api\Auth\UserCommercialRegisterRequest;

final class UserCommercialRegisterAction
{
    public function __construct(private UserCommercialRepository $userRepository)
    {
    }

    public function execute(UserCommercialRegisterRequest $request): array
    {
        $array = $request->validated();

        if ($request->hasFile('image')) {
            data_set($array, "image", saveImage("profile", $request->image));
        }
        $seller = $this->userRepository->create($array);

        // $token = $seller->createToken("env('SECRET')")->plainTextToken;

        return ["data" => $seller];
    }
}
