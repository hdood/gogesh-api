<?php

namespace App\Http\Middleware;

use App\Enum\EnumGeneral;
use App\Repository\SubscriptionRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMaxAdsPerNotification
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
            if ($request->get("place") == EnumGeneral::NOTIFICATION) {
                if ($currentSubscription->max_ads_per_notification <= 0) {
                    return response()->json(['message' => __("maximum_ads_per_notification_limit_reached")], 422);
                } else {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
        }
        return response()->json(['message' => __("you_dont_have_package")], 422);
    }
}
