<?php

namespace App\Http\Controllers\Api\Customer;

use App\Actions\Auth\UpdateEmailCustomerAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\UpdateEmailRequest as AuthUpdateEmailRequest;
use App\Http\Requests\Api\Seller\UpdateAvatarRequest;
use App\Repository\Api\CustomerRepository;
use App\Repository\Api\SellerRepository;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct(private CustomerRepository $repository)
    {
    }


    // public function updateAvatar(UpdateAvatarRequest $request)
    // {
    //     $this->repository->updateAvatar(Auth::id(), $request->validated());
    //     return response()->json(['success' => _("update_success")]);
    // }

    public function updateEmail(AuthUpdateEmailRequest $request, UpdateEmailCustomerAction $action)
    {
        $action->execute($request);
        return response()->json(['success' => _("update_success")]);
    }
}
