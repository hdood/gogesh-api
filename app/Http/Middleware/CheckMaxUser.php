<?php

namespace App\Http\Middleware;

use App\Repository\SubscriptionRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMaxUser
{

    public function __construct(private SubscriptionRepository $repository)
    {
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentSubscription = $this->repository->subscriptionByCommercialActivity(
            Auth::guard("sanctum")->user()->id
        );
        if ($currentSubscription) {
            if ($currentSubscription->max_users <= 0) {
                return response()->json(['message' => __("maximum_users_limit_reached")], 422);
            } else {
                return $next($request);
            }
        }
        return response()->json(['message' => __("you_dont_have_package")], 422);
    }
}
