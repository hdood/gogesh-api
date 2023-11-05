<?php

namespace App\Actions\CommercialActivity;

use App\Repository\Api\SellerRepository;
use App\Http\Requests\Api\Company\UpdateWorkDaysRequest;

class UpdateWorkDaysAction
{

    public function __construct(private  readonly  SellerRepository $sellerRepository)
    {
    }

    function execute($id, UpdateWorkDaysRequest $request)
    {
        $array = $request->validated();

        if ($request->has('work_days')) {
            data_set($array, "work_days", json_encode($array["work_days"]));
        }
        $this->sellerRepository->update(
            $id,
            $array
        );

        return response()->json('success');
    }
}
