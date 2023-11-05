<?php

namespace App\Http\Controllers\Dashboard\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use stdClass;

class MethodPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stripe = new stdClass();
        $stripe->key = env('STRIPE_KEY');
        $stripe->secret = env('STRIPE_SECRET');
        $stripe->name = env('STRIPE_NAME');
        $paypal = new stdClass();
        $paypal->id = env('PAYPAL_CLIENT_ID');
        $paypal->secret = env('PAYPAL_CLIENT_SECRET');
        $paypal->name = env('PAYPAL_NAME');
        return view('payments.paymentMethod.index', compact('stripe','paypal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->method == 'stripe') {
            setEnvironmentValue('STRIPE_KEY', $request->STRIPE_KEY);
            setEnvironmentValue('STRIPE_SECRET', $request->STRIPE_SECRET);
            setEnvironmentValue('STRIPE_NAME', $request->STRIPE_NAME);
            return response()->json('stripe');
        } elseif ($request->method == 'paypal') {
            setEnvironmentValue('PAYPAL_CLIENT_ID', $request->PAYPAL_ID);
            setEnvironmentValue('PAYPAL_CLIENT_SECRET', $request->PAYPAL_SECRET);
            setEnvironmentValue('PAYPAL_NAME', $request->PAYPAL_NAME);
            return response()->json('paypal');
        }
        return response()->json('no method');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
