<?php

namespace App\Actions\Auth;

use App\Http\Requests\Api\Auth\CustomerUpdateRequest;
use App\Repository\Api\CustomerRepository;
use Illuminate\Support\Facades\Auth;

class EditAccountCustomerAction
{


    public function __construct(private CustomerRepository $repository)
    {
    }

    public function execute(CustomerUpdateRequest $request)
    {

        $this->repository->update(Auth::id(), $request->validated());
    }
}
