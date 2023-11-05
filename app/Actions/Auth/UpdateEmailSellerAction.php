<?php

namespace App\Actions\Auth;

use App\Http\Requests\Api\Seller\UpdateEmailRequest;
use App\Repository\Api\SellerRepository;
use Illuminate\Support\Facades\Auth;

class UpdateEmailSellerAction
{


    public function __construct(private SellerRepository $repository)
    {
    }

    public function execute(UpdateEmailRequest $request)
    {

        $this->repository->update(Auth::id(), $request->validated());
    }
}
