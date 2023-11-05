<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\CompletedRegisterCustomerAction;
use App\Actions\Auth\CompletedRegisterSellerAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CustomerUpdateRequest;
use App\Http\Requests\Api\Auth\SellerComplateRegisterRequest;

class CompletedRegisterController extends Controller
{
    public function completedSeller(SellerComplateRegisterRequest $request, CompletedRegisterSellerAction $acttion)
    {
        return $acttion->execute($request);
    }

    public function completedCustomer(CustomerUpdateRequest $request, CompletedRegisterCustomerAction $acttion)
    {
        return $acttion->execute($request);
    }
}
