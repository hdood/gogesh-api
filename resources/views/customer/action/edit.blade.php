<?php
use App\Enum\EnumGeneral;
?>
@extends('layout')
@section('title', 'customers')

@section('menu4_a1', 'menu-active')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Edit Customer') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Edit Customer') }}</li>
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
            <form class="new-added-form" method="post" action="{{ route('customer.update', $customer->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" data-select2-id="18">

                    <div class="col-md-6 form-group">
                        <label>{{ __('First Name') }} *</label>
                        <input type="text" name="firstname" placeholder="" class="form-control"
                            value="{{ $customer->firstname }}" required>
                        @error('firstname')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Last Name') }} *</label>
                        <input type="text" name="lastname" placeholder="" class="form-control"
                            value="{{ $customer->lastname }}" required>
                        @error('lastname')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Email') }} *</label>
                        <input type="text" name="email" placeholder="" class="form-control"
                            value="{{ $customer->email }}" required>
                        @error('email')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Phone number') }} *</label>
                        <div class="form-control d-flex align-items-center">
                            <select name="country_code" id=""
                                style="
                            height: 100%;
                            border: none;
                            background: transparent;
                            outline: none;
                        ">
                                @php
                                    try {
                                        // Code that might throw an exception
                                        $phone = explode('-', $customer->phone)[2];
                                        $dial_code = explode('-', $customer->phone)[1];
                                    } catch (\Exception $e) {
                                        // Handle the exception
                                        $phone = null;
                                        $dial_code = null;
                                    }
                                @endphp
                                @foreach ($country_code as $item)
                                    <option value="{{ $item->alpha_2_code . '-' . $item->dial_code }}"
                                        @if ($dial_code == $item->dial_code) selected @endif>
                                        {{ $item->dial_code }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="phone" placeholder="Enter Your phone" class="form-control phone"
                                value="{{ $phone }}" required>
                            @error('phone')
                                <span class="text-red">{!! $message !!}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12  form-group">
                        <label>{{ __('gender') }} *</label>
                        <select id="gender" name="gender" class="select2 select2-hidden-accessible" required>
                            <option value="">{{ __('Select') }}</option>
                            <option value="{{ EnumGeneral::MALE }}" @if ($customer->gender == EnumGeneral::MALE) selected @endif>
                                {{ __(EnumGeneral::MALE) }}</option>
                            <option value="{{ EnumGeneral::FEMALE }}" @if ($customer->gender == EnumGeneral::FEMALE) selected @endif>
                                {{ __(EnumGeneral::FEMALE) }}</option>
                        </select>
                        @error('gender')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-12  form-group">
                        <label>{{ __('Status') }} *</label>
                        <select id="editstatus" name="status" class="select2 select2-hidden-accessible" required>
                            <option value="">Select</option>
                            <option value="{{ EnumGeneral::ACTIVE }}" @if ($customer->status == EnumGeneral::ACTIVE) selected @endif>
                                {{ __(EnumGeneral::ACTIVE) }}</option>
                            <option value="{{ EnumGeneral::INACTIVE }}" @if ($customer->status == EnumGeneral::INACTIVE) selected @endif>
                                {{ __(EnumGeneral::INACTIVE) }}</option>
                        </select>
                        @error('status')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-4  form-group">
                        <label>{{ __('Country') }} *</label>
                        <select id="addCountry" name="country_id" class="select2 select2-hidden-accessible">
                            <option value="">Select</option>
                            @if ($customer->country)
                                <option value="" selected>{{ $customer->country }}</option>
                            @endif
                            @foreach ($countries as $item)
                                <option value="{{ $item->id }}" @if ($customer->country_id == $item->id) selected @endif>
                                    @if (app()->getLocale() == 'en')
                                        {{ $item->name_en }}
                                    @else
                                        {{ $item->name_ar }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-4  form-group">
                        <label>{{ __('City') }} *</label>
                        <select id="addCity" name="city_id" class="select2 select2-hidden-accessible">
                            <option value="">Select</option>
                            @if ($customer->city)
                                <option value="" selected>{{ $customer->city }}</option>
                            @elseif ($customer->City)
                                <option value="{{ $customer->City->id }}" selected>{{ $customer->City->getName() }}
                                </option>
                            @endif
                        </select>
                        @error('city_id')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-4  form-group">
                        <label>{{ __('Region') }} *</label>
                        <select id="addRegion" name="region_id" class="select2 select2-hidden-accessible">
                            <option value="">Select</option>
                            @if ($customer->region)
                                <option value="" selected>{{ $customer->region }}</option>
                            @elseif ($customer->Region)
                                <option value="{{ $customer->Region->id }}" selected>{{ $customer->Region->getName() }}
                                </option>
                            @endif
                        </select>
                        @error('region_id')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Password') }} *</label>
                        <input autocomplete="off" type="password" name="password" placeholder="" class="form-control"
                            value="">
                        @error('password')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Confirme Password') }} *</label>
                        <input autocomplete="off" type="password" name="password_confirmation" placeholder=""
                            class="form-control" value="">
                        @error('password_confirmation')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
                        <a href="{{ route('customer.index') }}"
                            class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
                    </div>
                </div>
            </form>

        </div>
    </div>



@endsection
@section('script')
    <script>
        new Cleave('.phone', {
            numeral: true,
            numeralPositiveOnly: true,
            delimiter: '',
            numeralIntegerScale: 15,
            stripLeadingZeroes: false,
            numeralThousandsGroupStyle: 'lakh'
        });
    </script>
@endsection
