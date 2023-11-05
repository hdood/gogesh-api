<?php

declare(strict_types=1);

namespace App\Actions\Auth;


use App\Actions\Email\SendEmailVerificationCodeAction;
use App\Enum\EnumGeneral;
use App\Http\Requests\Api\Auth\SellerUpgradeRequest;
use App\Http\Resources\Api\Seller\SelleUpgraderResource;
use App\Repository\Api\SellerRepository;
use Illuminate\Support\Facades\Auth;

final class SellerUpgradeAction
{
    public function __construct(private readonly SellerRepository $sellerRepository, private readonly SendEmailVerificationCodeAction $sendEmailVerificationCodeAction)
    {
    }

    public function execute(SellerUpgradeRequest $request)
    {
        $array = $request->validated();
        if ($request->hasFile('logo')) {
            data_set($array, "logo", saveImage("logos", $request->logo));
        }

        data_set($array, "social_accounts", json_encode($array["social_accounts"]));
        data_set($array, "work_days", json_encode($array["work_days"]));
        data_set($array, "upgraded_status", EnumGeneral::PENDING);
        data_set($array, "upgraded", 1);
        data_set($array, "delivery", 1);

        $seller = $this->sellerRepository->update(Auth::id(), $array);
        $seller->specialities()->delete();
        foreach ($array['specialities_id'] as $key => $value) {
            $seller->specialities()->create([
                'seller_id' => $seller->id,
                'speciality_id' => $value
            ]);
        }
        $seller->seasons()->delete();
        foreach ($array['seasons_id'] as $key => $value) {
            $seller->seasons()->create([
                'seller_id' => $seller->id,
                'season_id' => $value
            ]);
        }
        return new SelleUpgraderResource($seller);
    }
}
