<?php
use App\Enum\EnumGeneral;
?>
@extends('layout')
@section('active10', 'active')
@section('menu10', 'block')
@section('app', 'id=app')
@section('menu10_a2', 'menu-active')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Method Payment') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Method Payment') }}</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <div class=" height-auto">
        <div class="card-body">
            <div>
                <method-stripe route="{{ route('payment.update-method') }}" stripe_key="{{ $stripe->key }}"
                    stripe_secret="{{ $stripe->secret }}" stripe_name="{{ $stripe->name }}" />
            </div>

        </div>
        <div class="card-body mt-5">
            <div>
                <method-paypal route="{{ route('payment.update-method') }}" paypal_id="{{ $paypal->id }}"
                    paypal_secret="{{ $paypal->secret }}" paypal_name="{{ $paypal->name }}" />
            </div>
        </div>
    </div>
@endsection
