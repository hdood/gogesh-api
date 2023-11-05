<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\subscription\ActiveCommercialActivityAction;
use App\Actions\subscription\PaidAdsAction;
use App\Actions\subscription\PaidOfferAction;
use App\Actions\subscription\UpdateSubscriptionAction;
use App\Actions\subscription\VerificationAction;
use Stripe\Charge;
use Stripe\Stripe;
use App\Enum\EnumGeneral;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Stripe\Exception\ApiErrorException;
use App\Exceptions\InvalidUrlProvidedException;
use App\Models\UrlModel;
use App\Repository\Dashboard\Package\PackageRepository;
use Exception;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function stripe(Request $request)
    {
        $current = url()->current() . '?' . http_build_query(request()->input());
        $url = UrlModel::where('url', $current)->where('used', 1)->first();
        if (!$request->hasValidSignature() || $url) {
            throw new InvalidUrlProvidedException();
        }
        $amount = encrypt($request->query('amount'));
        $queryParams = encrypt($request->query());
        return view('stripe.index', compact('amount', 'queryParams', 'current'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(
        Request $request,
        PackageRepository $repository,
        UpdateSubscriptionAction $subscribe,
        VerificationAction $verification,
        ActiveCommercialActivityAction $actived,
        PaidAdsAction $paidAdsAction,
        PaidOfferAction $paidOfferAction
    ) {
        $data = decrypt($request->queryParams);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                "amount" => $data['amount'] * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
            ]);
        } catch (ApiErrorException $e) {
            // Handle Stripe API errors
            Session::flash('error', $e->getMessage());
            return back();
        } catch (Exception $e) {
            // Handle other general errors
            Session::flash('error', 'An error occurred');
            return back();
        }
        switch ($data['type']) {
            case EnumGeneral::SUBSCRIPTION:
                $subscribe->execute($data);
                Session::flash('success', 'Payment successful!');
                break;
            case EnumGeneral::FEES:
                $package = $repository->getById($data['package_id']);
                break;
            case EnumGeneral::VERIFICATION:
                $verification->execute($data['id']);
                Session::flash('success', 'Payment successful!');
                break;
            case EnumGeneral::ACTIVE_COMMERCIAL:
                $actived->execute($data['id']);
                Session::flash('success', 'Payment successful!');
                break;
            case EnumGeneral::ADS_PAID:
                $paidAdsAction->execute($data['ads_id']);
                Session::flash('success', 'Payment successful!');
                break;
            case EnumGeneral::OFFER_PAID:
                $paidOfferAction->execute($data['offer_id']);
                Session::flash('success', 'Payment successful!');
                break;
            default:
                # code...
                break;
        }
        Transaction::create([
            "seller_id" => $data['id'],
            "amount" => $data['amount'],
            "type" => $data['type'],
            "method_name" => $charge->source->brand
        ]);
        $url = UrlModel::where('url', $request->url)->first();
        $url->used = true;
        $url->save();
        Session::flash('success', 'Payment successful!');

        return view('stripe.success');
    }
}
