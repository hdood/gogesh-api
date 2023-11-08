<?php

declare(strict_types=1);

namespace App\Actions\Auth;


use App\Actions\Email\SendEmailVerificationCodeAction;
use App\Http\Requests\Api\Auth\SellerRegisterRequest;
use App\Http\Resources\SellerResource;
use App\Repository\Api\SellerRepository;


final class SellerRegisterAction
{
    public function __construct(private readonly SellerRepository $sellerRepository, private readonly SendEmailVerificationCodeAction $sendEmailVerificationCodeAction)
    {
    }

    public function execute(SellerRegisterRequest $request): array
    {
        $array = $request->validated();

        if ($request->hasFile('image')) {
            data_set($array, "image", saveImage("profile", $request->image));
        }

        if ($request->hasFile('civil_card')) {
            data_set($array, "civil_card", saveImage("document", $request->civil_card));
        } 

        if ($request->hasFile('commercial_license')) {
            data_set($array, "commercial_license", saveImage("document", $request->civil_card));
        }

        if ($request->hasFile('signature_approval')) {
            data_set($array, "signature_approval", saveImage("document", $request->civil_card));
        }
        $array['completed'] = 1;
        $seller = $this->sellerRepository->create($array);
        foreach ($array['sections_id'] as $key => $value) {
            $seller->sections()->create([
                'seller_id' => $seller->id,
                'section_id' => $value
            ]);
        }
        foreach ($array['services_id'] as $key => $value) {
            $seller->services()->create([
                'seller_id' => $seller->id,
                'service_id' => $value
            ]);
        }
        // $this->sendEmailVerificationCodeAction->execute($seller->email);

        $token = $seller->createToken("env('SECRET')")->plainTextToken;

        if (!$seller->hasVerifiedEmail()) {
            $seller->markEmailAsVerified();
        }
        return ["data" => new SellerResource($seller), "token" => $token];
    }
}
