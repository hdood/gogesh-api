<?php

namespace App\Http\Middleware;

use App\Repository\SubscriptionRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscriptionDuration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,SubscriptionRepository $repository): Response
    {
        $currentSubscription = $repository->subscriptionByCommercialActivity(
            Auth::guard("sanctum")->user()->id
        );
        if ($currentSubscription) {
            $durationInMonths = $currentSubscription->duration;
            $updatedDate = Carbon::parse($currentSubscription->updated_date);
            $expirationDate = $updatedDate->addMonths($durationInMonths);

            if (Carbon::now()->gt($expirationDate)) {
                return response()->json(['message' => __("subscription_has_ended.")]);
            }
        }

        return $next($request);
    }
}
