<?php
use App\Enum\EnumGeneral;
?>
@extends('layout')
@section('title', 'users')

@section('menu9_a1', 'menu-active')

@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Add User') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Add User') }}</li>
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
            <form class="new-added-form" method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row" data-select2-id="18">

                    <div class="col-md-12 form-group">
                        <label>{{ __('Name') }} *</label>
                        <input type="text" name="name" placeholder="" class="form-control" value="" required>
                        @error('name')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label>{{ __('Email') }} *</label>
                        <input type="text" name="email" placeholder="" class="form-control" value="" required>
                        @error('email')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>

                    <div class="col-12  form-group">
                        <label>{{ __('Role') }} *</label>
                        <select id="city" name="roles[]" class="select2 select2-hidden-accessible" multiple>
                            <option disabled>Select</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('roles')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    {{-- <div class="col-12  form-group">
                        <label>{{ __('Status') }} *</label>
                        <select id="editstatus" name="status" class="select2 select2-hidden-accessible" required>
                            <option value="">Select</option>
                            <option value="{{ EnumGeneral::ACTIVE }}">
                                {{ __(EnumGeneral::ACTIVE) }}</option>
                            <option value="{{ EnumGeneral::INACTIVE }}">
                                {{ __(EnumGeneral::INACTIVE) }}</option>
                        </select>
                        @error('status')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div> --}}
                    <div class="col-md-6 form-group">
                        <label>{{ __('Password') }} *</label>
                        <input type="password" name="password" placeholder="" class="form-control" value="" required>
                        @error('password')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Confirme Password') }} *</label>
                        <input type="password" name="password_confirmation" placeholder="" class="form-control"
                            value="" required>
                        @error('password_confirmation')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
                        <a href="{{ route('user.index') }}"
                            class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>
    </div>



@endsection
