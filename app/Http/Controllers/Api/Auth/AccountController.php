<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\EditAccountCustomerAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CustomerUpdateRequest;
use App\Http\Resources\Api\customer\CustomerResource;
use App\Http\Resources\Api\customer\UserCommercialResource;
use App\Http\Resources\Api\Seller\SellerResourceDetails;
use App\Http\Resources\SellerResource;
use App\Models\Customer;
use App\Models\Seller;
use App\Repository\Api\SellerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function getAccountSeller(): SellerResource
    {
        return new SellerResource(Auth::user());
    }
    public function userCommercialProfile(): UserCommercialResource
    {
        return new UserCommercialResource(Auth::user());
    }
    public function getAccountSellerById($id, SellerRepository $repository): SellerResourceDetails
    {
        return new SellerResourceDetails($repository->getById($id));
    }
    public function editAccountSeller()
    {
        return;
    }

    public function getAccountCustomer(): CustomerResource
    {
        return new CustomerResource(Auth::user());
    }

    public function editAccountCustomer(CustomerUpdateRequest $request, EditAccountCustomerAction $action): JsonResponse
    {
        $action->execute($request);
        return response()->json(['success' => 'edit_account']);
    }

    public function deleteSeller()
    {
        Seller::findOrfail(Auth::id())->delete();
        return response()->json(['success' => 'delete_account']);
    }

    public function deleteCustomer()
    {
        Customer::findOrfail(Auth::id())->delete();
        return response()->json(['success' => 'delete_account']);
    }
}
