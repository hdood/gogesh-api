<?php
use App\Enum\EnumGeneral;
?>
@extends('layout')
@section('title', 'duration')

@section('active1', 'active')
@section('menu1', 'block')
@section('menu1_a3', 'menu-active')

@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Edit Duration') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Edit Duration') }}</li>
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
            <form class="new-added-form" method="post" action="{{ route('offer.duration.update', $duration->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6  form-group">
                        <label>{{ __('Status') }} *</label>
                        <select id="editstatus" name="status" class="select2 select2-hidden-accessible">
                            <option value="">Select</option>
                            <option value="{{ EnumGeneral::ACTIVE }}"@if ($duration->status == EnumGeneral::ACTIVE) selected @endif>
                                {{ __(EnumGeneral::ACTIVE) }}</option>
                            <option value="{{ EnumGeneral::INACTIVE }}"@if ($duration->status == EnumGeneral::INACTIVE) selected @endif>
                                {{ __(EnumGeneral::INACTIVE) }}</option>
                        </select>
                        @error('status')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Price') }} *</label>
                        <input type="text" name="price" placeholder="" class="form-control"
                            value="{{ $duration->price }}" required>
                        @error('price')
                            <span class="text-red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Duration') }} *</label>
                        <input type="text" name="duration" placeholder="" class="form-control"
                            value="{{ $duration->duration }}" required>
                        @error('duration')
                            <span class="text-red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6  form-group">
                        <label>{{ __('Type') }} *</label>
                        <select id="edittype" name="type" class="select2 select2-hidden-accessible">
                            <option value="">Select</option>
                            <option value="{{ EnumGeneral::DAYS }}"@if ($duration->type == EnumGeneral::DAYS) selected @endif>
                                {{ __(EnumGeneral::DAYS) }}</option>
                            <option value="{{ EnumGeneral::WEEK }}"@if ($duration->type == EnumGeneral::WEEK) selected @endif>
                                {{ __(EnumGeneral::WEEK) }}</option>
                            <option value="{{ EnumGeneral::MONTH }}"@if ($duration->type == EnumGeneral::MONTH) selected @endif>
                                {{ __(EnumGeneral::MONTH) }}</option>
                            <option value="{{ EnumGeneral::YEAR }}"@if ($duration->type == EnumGeneral::YEAR) selected @endif>
                                {{ __(EnumGeneral::YEAR) }}</option>
                        </select>
                        @error('type')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
                        <a href="{{ route('offer.duration.index') }}"
                            class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>
    </div>



@endsection
