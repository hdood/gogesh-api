<?php

namespace App\Http\Controllers\Api\Stripe;

use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StripCheckoutRequest;
use App\Exceptions\InvalidUrlProvidedException;
use App\Models\UrlModel;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function stripe(StripCheckoutRequest $request)
    {
        $signedUrl = URL::temporarySignedRoute(
            'stripe',
            Carbon::now()->addMinutes(2),
            [
                'id' => Auth::id(),
                'amount' => $request->amount,
                'type' => $request->type,
                'package_id' => $request->package_id,
                'ads_id' => $request->ads_id,
                'offer_id' => $request->offer_id,
            ]
        );
        UrlModel::create([
            'url' => $signedUrl
        ]);
        return response()->json(['url' => $signedUrl]);
    }
}
