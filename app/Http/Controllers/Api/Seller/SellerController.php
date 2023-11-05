<?php

namespace App\Http\Controllers\Api\Seller;

use App\Actions\Auth\SellerUpdateAction;
use App\Actions\Auth\SellerUpgradeAction;
use App\Actions\Auth\UpdateEmailSellerAction;
use App\Actions\Seller\GetUsersCommercialActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\SellerUpgradeRequest;
use App\Http\Requests\Api\Seller\UpdateAvatarRequest;
use App\Http\Requests\Api\Seller\UpdateEmailRequest;
use App\Http\Requests\Api\Seller\UpdateSellerRequest;
use App\Http\Resources\Api\Seller\SellerResource;
use App\Models\UserCommecrialActivity;
use App\Repository\Api\SellerRepository;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function __construct(private SellerRepository $repository)
    {
    }

    public function edit()
    {
        return new SellerResource(Auth::user());
    }
    public function update(UpdateSellerRequest $request, SellerUpdateAction $action)
    {
        return $action->execute($request);
    }
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $this->repository->updateAvatar(Auth::id(), $request->validated());
        return response()->json(['success' => _("update_success")]);
    }

    public function updateEmail(UpdateEmailRequest $request, UpdateEmailSellerAction $action)
    {
        $action->execute($request);
        return response()->json(['success' => _("update_success")]);
    }

    public function users(GetUsersCommercialActivity $action)
    {
        return $action->execute();
    }
    public function deleteUser($id)
    {
        UserCommecrialActivity::findOrfail($id)->delete();
        return response()->json(['success' => _("the user is delete")]);
    }
    public function upgradeAccount(SellerUpgradeRequest $request, SellerUpgradeAction $action)
    {

        return $action->execute($request);
    }
}
