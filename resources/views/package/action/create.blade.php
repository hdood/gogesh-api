<?php
use App\Enum\EnumGeneral;
?>
@extends('layout')
@section('title', 'packages')

@section('menu7_a1', 'menu-active')


@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Add Package') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Add Package') }}</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto" data-select2-id="21">
        <div class="card-body" data-select2-id="20">
            <div class="heading-layout1">
                <div class="item-title">
                </div>

            </div>
            <form class="new-added-form" method="post" action="{{ route('package.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row" data-select2-id="18">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{ __('Name Ar') }} *</label>
                                <input type="text" name="name_ar" placeholder="" class="form-control" value=""
                                    required>
                                @error('name_ar')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Name En') }} *</label>
                                <input type="text" name="name_en" placeholder="" class="form-control" value=""
                                    required>
                                @error('name_en')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Number of listings') }} *</label>
                                <input type="text" name="max_offers" id="credits" placeholder="" class="form-control"
                                    value="" required>
                                @error('max_offers')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Price Add Offer') }} *</label>
                                <input type="text" name="offer_addition_cost" id="price-addOffer" placeholder=""
                                    class="form-control" value="" required>
                                @error('offer_addition_cost')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Change Offer') }} *</label>
                                <div class="position-relative">
                                    <input type="text" name="max_offer_change" id="change-offer" placeholder=""
                                        class="form-control" value="" required>
                                    <span
                                        style="
                                        position: absolute;
                                        top: 10px;
                                        @if (app()->getLocale() == 'en') right: 10px; @else left:10px @endif
                                    ">
                                        {{ __('One Month') }}
                                    </span>
                                </div>
                                @error('max_offer_change')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Price Change Offer') }} *</label>
                                <input type="text" name="offer_change_cost" id="price-change-offer" placeholder=""
                                    class="form-control" value="" required>
                                @error('offer_change_cost')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Number of Speciality') }} *</label>
                                <input type="text" name="max_specialties" id="number_speciality" placeholder=""
                                    class="form-control" value="" required>
                                @error('max_specialties')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>


                            <div class="col-md-6 form-group">
                                <label>{{ __('Price Add Speciality') }} *</label>
                                <input type="text" name="specialty_addition_cost" id="price_add_speciality"
                                    placeholder="" class="form-control" value="" required>
                                @error('specialty_addition_cost')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{ __('Send Notification') }} *</label>
                                <div class="position-relative">
                                    <input type="text" name="notification_cost" id="send_notification" placeholder=""
                                        class="form-control" value="" required>
                                    <span
                                        style="
                                        position: absolute;
                                        top: 10px;
                                        @if (app()->getLocale() == 'en') right: 10px; @else left:10px @endif
                                    ">
                                        {{ __('For 1000 person') }}
                                    </span>
                                </div>
                                @error('notification_cost')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group row">
                                <div class="col-md-12 form-group">
                                    <h3>{{ __('Ads') }}</h3>
                                    <hr>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>{{ __('Number of Notification') }}</label>
                                    <input type="text" name="max_ads_per_notification" id="number_notification"
                                        placeholder="" class="form-control" value="">
                                    @error('max_ads_per_notification')
                                        <span class="text-red">{!! $message !!}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>{{ __('Free Ads') }} </label>
                                    <div class="position-relative">
                                        <input type="text" name="free_ads_duration" id="free_ads" placeholder=""
                                            class="form-control" value="">
                                        <span
                                            style="
                                            position: absolute;
                                            top: 10px;
                                            @if (app()->getLocale() == 'en') right: 10px; @else left:10px @endif
                                        ">
                                            {{ __('Day') }}
                                        </span>
                                    </div>
                                    @error('free_ads_duration')
                                        <span class="text-red">{!! $message !!}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>{{ __('Sector Baner') }} *</label>
                                    <div class="position-relative">
                                        <input type="text" name="max_ads_via_sector_banner" id="ads_sector_baner"
                                            placeholder="" class="form-control" value="" required>
                                        <span
                                            style="
                                            position: absolute;
                                            top: 10px;
                                            @if (app()->getLocale() == 'en') right: 10px; @else left:10px @endif
                                        ">
                                            {{ __('One Month') }}
                                        </span>
                                    </div>
                                    @error('max_ads_via_sector_banner')
                                        <span class="text-red">{!! $message !!}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>{{ __('Discount Ads') }}</label>
                                    <div class="position-relative">
                                        <input type="text" name="ads_discount" id="discount_ads" placeholder=""
                                            class="form-control" value="">
                                        <span
                                            style="
                                            position: absolute;
                                            top: 10px;
                                            @if (app()->getLocale() == 'en') right: 10px; @else left:10px @endif
                                        ">
                                            {{ __('%') }}
                                        </span>
                                    </div>
                                    @error('ads_discount')
                                        <span class="text-red">{!! $message !!}</span>
                                    @enderror
                                </div>
                            </div>
                            <output class="row col-12">
                                <div class="col-md-12 form-group">
                                    <h3>{{ __('Feature') }}</h3>
                                    <hr>
                                </div>
                                <div class="col-12 row">
                                    <div class="col-md-6 form-group">
                                        <label>{{ __('Title En') }} *</label>
                                        <input type="text" name="features[]" placeholder="" class="form-control"
                                            value="">
                                        @error('features')
                                            <span class="text-red">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>{{ __('Title Ar') }} *</label>
                                        <input type="text" name="features_ar[]" placeholder="" class="form-control"
                                            value="">
                                        @error('features_ar')
                                            <span class="text-red">{!! $message !!}</span>
                                        @enderror
                                    </div>
                                </div>
                            </output>
                            <button type="button" id="add-feature"
                                class="m-5 mb-3 btn-fill-md radius-30 text-light bg-dark-pastel-green">{{ __('Add Feature') }}
                                <i class="fa-solid fa-plus">
                                </i></button>
                            {{-- <button type="button" id="add-feature"
                                class="m-3 ms-5 btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('Add Feature') }}</button> --}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-12  form-group">
                                <label>{{ __('Status') }} *</label>
                                <select id="editstatus" name="status" class="select2 select2-hidden-accessible">
                                    <option value="">Select</option>
                                    <option value="{{ EnumGeneral::ACTIVE }}">
                                        {{ __(EnumGeneral::ACTIVE) }}</option>
                                    <option value="{{ EnumGeneral::INACTIVE }}">
                                        {{ __(EnumGeneral::INACTIVE) }}</option>
                                </select>
                                @error('status')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{ __('Duration Ads') }} *</label>
                                <div class="position-relative">
                                    <input type="text" name="duration" id="duration_ads" placeholder=""
                                        class="form-control" value="" required>
                                    <span
                                        style="
                                        position: absolute;
                                        top: 10px;
                                        @if (app()->getLocale() == 'en') right: 10px; @else left:10px @endif
                                    ">
                                        {{ __('Month') }}
                                    </span>
                                </div>
                                @error('duration')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-12  form-group">
                                <label class="form-label">{{ __('Price') }}*</label>
                                <input class="form-control" type="text" name="price" id="price_ads" value=""
                                    required />
                                @error('price')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>

                            <div class="col-12  form-group">
                                <label class="form-label">{{ __('Number User') }}*</label>
                                <input class="form-control" type="text" name="max_users" id="number_user"
                                    value="" required />
                                @error('max_users')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
                        <a href="{{ route('package.index') }}"
                            class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>
    </div>



@endsection
