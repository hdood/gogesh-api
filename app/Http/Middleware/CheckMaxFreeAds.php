<?php

namespace App\Http\Middleware;

use App\Repository\SubscriptionRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMaxFreeAds
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

        /// first check if the ad is free ad √
        /// then check the max_free_ads count
        /// than check the duration √
        if ($currentSubscription) {
            if ($currentSubscription->max_free_ads <= 0 && $request->get("duration") <=  $currentSubscription->free_ads_duration) {
                return response()->json(['message' => 'Maximum free ads limit reached'], 422);
            } else {
                return $next($request);
            }
        }
        return response()->json(['message' => __("you_dont_have_package")], 422);
    }
}
