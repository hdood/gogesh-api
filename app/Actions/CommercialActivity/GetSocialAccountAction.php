<?php

namespace App\Actions\CommercialActivity;

use App\Repository\Api\SellerRepository;
use App\Http\Resources\Api\CommercialActivity\SocialAccountResource;
use Illuminate\Support\Facades\Auth;

class GetSocialAccountAction
{

    public function __construct(private  readonly  SellerRepository $sellerRepository)
    {
    }

    function execute(): SocialAccountResource
    {

        return new SocialAccountResource($this->sellerRepository->getById(Auth::id()));
    }
}
