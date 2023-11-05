<?php

namespace App\Actions\Seller;

use App\Http\Resources\Api\customer\UserCommercialResource;
use Illuminate\Support\Facades\Auth;

class GetUsersCommercialActivity
{
    public function __construct()
    {
    }

    public function execute()
    {
        return UserCommercialResource::collection(Auth::user()->users);
    }
}
