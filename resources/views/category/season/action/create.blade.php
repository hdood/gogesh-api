<?php
use App\Enum\EnumGeneral;
?>
@extends('layout')
@section('title', 'seasons')

@section('active3', 'active')
@section('menu3', 'block')
@section('menu3_a5', 'menu-active')

@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Add Season') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Add Season') }}</li>
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
            <form class="new-added-form" method="post" action="{{ route('category.season.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row" data-select2-id="18">

                    <div class="col-md-6 form-group">
                        <label>{{ __('Name Ar') }} *</label>
                        <input type="text" name="name_ar" placeholder="" class="form-control" value="" required>
                        @error('name_ar')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Name En') }} *</label>
                        <input type="text" name="name_en" placeholder="" class="form-control" value="" required>
                        @error('name_en')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Season Start') }}</label>
                        <input autocomplete="off" name="season_start" type="text" placeholder="mm-dd"
                            class="form-control air-datepicker" data-position="bottom right" required>
                        <i class="far fa-calendar-alt"></i>
                        @error('season_start')
                            <span class="text-red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Season End') }}</label>
                        <input autocomplete="off" name="season_end" type="text" placeholder="mm-dd"
                            class="form-control air-datepicker" data-position="bottom right" required>
                        <i class="far fa-calendar-alt"></i>
                        @error('season_end')
                            <span class="text-red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12  form-group">
                        <label>{{ __('Status') }} *</label>
                        <select id="editstatus" name="status" class="select2 select2-hidden-accessible">
                            <option value="">Select</option>
                            <option value="{{ EnumGeneral::ACTIVE }}" selected>
                                {{ __(EnumGeneral::ACTIVE) }}</option>
                            <option value="{{ EnumGeneral::INACTIVE }}">
                                {{ __(EnumGeneral::INACTIVE) }}</option>
                        </select>
                        @error('status')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
                        <a href="{{ route('category.season.index') }}"
                            class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>
    </div>



@endsection
@section('script')
    <script>
        $('.air-datepicker').datepicker({});
    </script>
@endsection
