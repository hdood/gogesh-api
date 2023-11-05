<?php

namespace App\Actions\CommercialActivity;

use App\Repository\Api\SellerRepository;

use App\Http\Resources\Api\CommercialActivity\WorkDaysResource;
use Illuminate\Support\Facades\Auth;

class GetWorkDaysAction
{

    public function __construct(private  readonly  SellerRepository $sellerRepository)
    {
    }

    function execute(): WorkDaysResource
    {

        return new WorkDaysResource($this->sellerRepository->getById(Auth::id()));
    }
}
