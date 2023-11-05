<?php

namespace App\Http\Middleware;

use App\Enum\EnumGeneral;
use App\Models\Offer;
use App\Repository\SubscriptionRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMaxOfferChangeForUpdate
{
    public function __construct(private SubscriptionRepository $repository)
    {
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $currentSubscription = $this->repository->subscriptionByCommercialActivity(
            Auth::guard("sanctum")->user()->id
        );

        if ($currentSubscription) {
            $id = $request->route('id');
            $status = Offer::findOrfail($id)->status == EnumGeneral::APPROVED;
            if ($currentSubscription->max_offer_change <= 0 && $status) {
                return response()->json(['message' => __("maximum_offer_change_limit_reached")], 422);
            } else {
                return $next($request);
            }
        }
        return response()->json(['message' => __("you_dont_have_package")], 422);
    }
}
