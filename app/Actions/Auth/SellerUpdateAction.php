<?php

declare(strict_types=1);

namespace App\Actions\Auth;


use App\Enum\EnumGeneral;
use App\Http\Requests\Api\Seller\UpdateSellerRequest;
use App\Repository\Api\SellerRepository;
use Illuminate\Support\Facades\Auth;

final class SellerUpdateAction
{
    public function __construct(private readonly SellerRepository $sellerRepository)
    {
    }

    public function execute(UpdateSellerRequest $request)
    {
        $data = $request->validated();
        if (!empty($request->country_id)) {
            $data['country'] = null;
            $data['city'] = null;
            $data['region'] = null;
        }

        if ($request->hasFile('civil_card')) {
            data_set($array, "civil_card", saveImage("document", $request->civil_card));
        } else {
            data_forget($array, 'civil_card');
        }

        if ($request->hasFile('commercial_license')) {
            data_set($array, "commercial_license", saveImage("document", $request->civil_card));
        } else {
            data_forget($array, 'commercial_license');
        }

        if ($request->hasFile('signature_approval')) {
            data_set($array, "signature_approval", saveImage("document", $request->civil_card));
        } else {
            data_forget($array, 'signature_approval');
        }
        data_set($data, 'status', EnumGeneral::UPDATED);
        $seller = $this->sellerRepository->update(Auth::id(), $data);
        $seller->sections()->delete();
        foreach ($array['sections_id'] as $key => $value) {
            $seller->sections()->create([
                'seller_id' => $seller->id,
                'section_id' => $value
            ]);
        }

        $seller->services()->delete();
        foreach ($array['services_id'] as $key => $value) {
            $seller->services()->create([
                'seller_id' => $seller->id,
                'service_id' => $value
            ]);
        }
        return response()->json(['success' => _("update_success")]);
    }
}
