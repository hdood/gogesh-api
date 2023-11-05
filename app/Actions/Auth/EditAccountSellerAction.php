<?php

namespace App\Actions\Auth;

use App\Http\Requests\Api\Auth\CheckCodeRequest;
use App\Repository\Api\SellerRepository;
use Illuminate\Support\Facades\Auth;

class EditAccountSellerAction
{


    public function __construct(private SellerRepository $repository)
    {
    }

    public function execute(CheckCodeRequest $request): string
    {

        $this->repository->update(Auth::id(), $request->validated());
    }
}
