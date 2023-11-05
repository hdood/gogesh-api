@extends('layout')
@section('title', 'reason')

@section('active1', 'active')
@section('menu1', 'block')

@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Edit Reason') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Edit Reason') }}</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto" data-select2-id="21">
        <div class="card-body" data-select2-id="20">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>{{ __('add new') }}</h3>
                </div>

            </div>
            <form class="new-added-form" method="post" action="{{ route('offer.reason.update', $reason->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" data-select2-id="18">

                    <div class="col-md-6 form-group">
                        <label>{{ __('title Ar') }} *</label>
                        <input type="text" name="title_ar" placeholder="" class="form-control"
                            value="{{ $reason->title_ar }}" required>
                        @error('title_ar')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('title En') }} *</label>
                        <input type="text" name="title_en" placeholder="" class="form-control"
                            value="{{ $reason->title_en }}" required>
                        @error('title_en')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Description Ar') }} *</label>
                        <textarea class="textarea form-control" name="description_ar" id="form-message" cols="10" rows="4">{{ $reason->description_ar }}</textarea>
                        @error('description_ar')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Description En') }} *</label>
                        <textarea class="textarea form-control" name="description_en" id="form-message" cols="10" rows="4">{{ $reason->description_en }}</textarea>
                        @error('description_en')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
                        <a href="{{ route('offer.reason.index') }}"
                            class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>
    </div>



@endsection
