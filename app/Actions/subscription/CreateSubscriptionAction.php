<?php

namespace App\Actions\subscription;


use App\Http\Requests\Api\subscription\SubscribeRequest;
use App\Http\Resources\Api\subscription\SubscriptionResource;
use App\Repository\Dashboard\Package\PackageRepository;
use App\Repository\SubscriptionRepository;
use Illuminate\Support\Facades\Auth;

class CreateSubscriptionAction
{

    public function __construct(private readonly SubscriptionRepository $repository, private readonly PackageRepository $packageRepository)
    {
    }

    public function execute(SubscribeRequest $request)
    {
        $package = $this->packageRepository->getById($request->get("package_id"));
        $commercialActivityId = Auth::guard("sanctum")->user()->commercialActivity->id;

        $packageData = $package->toArray();

        unset($packageData['status']);

        $packageData['commercial_activity_id'] = $commercialActivityId;

        return  new SubscriptionResource($this->repository->create($packageData));
    }

}
