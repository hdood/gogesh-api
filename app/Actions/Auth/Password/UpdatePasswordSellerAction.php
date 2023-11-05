<?php

namespace App\Actions\Auth\Password;

use App\Models\Seller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\UnauthorizedException;
use App\Http\Requests\Api\Auth\UpdatePasswordSellerRequest;

class UpdatePasswordSellerAction
{
    /**
     * @throws UnauthorizedException
     */
    public function execute(UpdatePasswordSellerRequest $request)
    {
        $auth = Auth::user();

        // The passwords matches
        if (!Hash::check($request->current_password, $auth->password)) {
            // return response()->json(["error" => "Current Password is Invalid"]);
            return new JsonResponse(["error" => "Current Password is Invalid"], 400);
        }

        $user =  Seller::find($auth->id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return new JsonResponse(["success" => "Password Changed Successfully"], 200);
        // return response()->json(["success" => "Password Changed Successfully"]);
    }
}
