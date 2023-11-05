<?php

namespace App\Actions\subscription;


use App\Repository\Api\SellerRepository;
use Illuminate\Support\Facades\Auth;

class VerificationAction
{

    public function __construct(private readonly SellerRepository $repository)
    {
    }

    public function execute($id)
    {
        $this->repository->verification($id);
    }
}
