<?php

namespace App\Actions\Auth;

use App\Http\Requests\Api\Auth\CustomerUpdateRequest;
use App\Http\Resources\Api\customer\CustomerResource;
use App\Repository\Api\CustomerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CompletedRegisterCustomerAction
{


    public function __construct(private readonly CustomerRepository $repository)
    {
    }

    public function execute(CustomerUpdateRequest $request)
    {
        $data = $request->validated();
        $data['completed'] = 1;
        if ($request->hasFile('image')) {
            data_set($data, "image", saveImage("profile", $request->image));
        }

        $this->repository->update(Auth::id(), $data);
        return new JsonResponse(["customer" => new CustomerResource($this->repository->getById(Auth::id()))]);
    }
}
