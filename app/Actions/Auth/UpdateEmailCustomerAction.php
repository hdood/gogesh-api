<?php

namespace App\Actions\Auth;

use App\Http\Requests\Api\Auth\UpdateEmailRequest;
use App\Repository\Api\CustomerRepository;
use Illuminate\Support\Facades\Auth;

class UpdateEmailCustomerAction
{


    public function __construct(private CustomerRepository $repository)
    {
    }

    public function execute(UpdateEmailRequest $request)
    {

        $this->repository->update(Auth::id(), $request->validated());
    }
}
