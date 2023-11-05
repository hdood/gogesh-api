@extends('layout')
@section('title', 'order')

@section('active1', 'active')
@section('menu1', 'block')

@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Edit Offer') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Edit Offer') }}</li>
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
            <form class="new-added-form" method="post" action="{{ route('offer.update', $offer->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" data-select2-id="18">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>{{ __('Title') }} *</label>
                                <input type="text" name="title" placeholder="" class="form-control"
                                    value="{{ $offer->title }}" required>
                                @error('title')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Description') }} *</label>
                                <textarea class="textarea form-control" name="description" id="form-message" cols="10" rows="4">{{ $offer->description }}</textarea>
                                @error('description')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('Condition') }} *</label>
                                <textarea class="textarea form-control" name="condition" id="form-message" cols="10" rows="4">{{ $offer->condition }}</textarea>
                                @error('condition')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{ __('speciality') }} *</label>
                                <select class="select2 select2-hidden-accessible" name="speciality_id">
                                    @foreach ($sectors as $sector)
                                        <optgroup
                                            label="@if (app()->getLocale() == 'en') {{ $sector->name_en }}@else{{ $sector->name_ar }} @endif"
                                            style="color:aqua">
                                            @foreach ($sector->activities as $activity)
                                                @if ($activity->specialities)
                                                    @foreach ($activity->specialities as $speciality)
                                                        <option value="{{ $speciality->id }}"
                                                            @if ($offer->speciality_id == $speciality->id) selected @endif>
                                                            @if (app()->getLocale() == 'en')
                                                                {{ $activity->name_en . ' > ' . $speciality->name_en }}
                                                            @else
                                                                {{ $activity->name_ar . ' > ' . $speciality->name_ar }}
                                                            @endif

                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('speciality_id')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="organization" class="form-label">{{ __('Season') }}</label>
                                <select class="select2 select2-hidden-accessible" name="season_id">
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach ($season as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($offer->season_id == $item->id) selected @endif>{{ $item->season }}
                                            {{ __($item->name_ar) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('season_id')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="organization" class="form-label">{{ __('Duration') }}</label>
                                <select class="select2 select2-hidden-accessible" name="duration_id">
                                    @foreach ($duration as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($offer->duration_id == $item->id) selected @endif>{{ $item->duration }}
                                            {{ __($item->type) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('duration_id')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-md-6" form-group>
                                <label for="organization"
                                    class="form-label">{{ __('Highlight your offer title in bold') }}</label>
                                <div class="row">
                                    <div class="form-check mx-3 col-md-4">
                                        <input name="bold" class="form-check-input" type="radio" value="0"
                                            @if ($offer->bold == 0) checked @endif>
                                        <label class="form-check-label" for="bold">
                                            No
                                        </label>
                                    </div>
                                    <div class="form-check mx-3 col-md-4">
                                        <input name="bold" class="form-check-input" type="radio" value="1"
                                            @if ($offer->bold == 1) checked @endif>
                                        <label class="form-check-label" for="bold">
                                            Yes
                                        </label>
                                    </div>
                                    @error('bold')
                                        <span class="text-red">{!! $message !!}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-12  form-group">
                                <label>{{ __('Status') }} *</label>
                                <select id="editstatus" name="status" class="select2 select2-hidden-accessible">
                                    <option value="">Select</option>
                                    <option value="Approved" @if ($offer->status == 'Approved') selected @endif>
                                        {{ __('Approved') }}</option>
                                    <option value="Rejected" @if ($offer->status == 'Rejected') selected @endif>
                                        {{ __('Rejected') }}</option>
                                    <option value="PENDING" @if ($offer->status == 'Pending') selected @endif>
                                        {{ __('Pending') }}</option>
                                </select>
                                @error('status')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-12 form-group" id="reason">
                                <label class="form-label">{{ __('Reason') }}</label>
                                <select class="select2 select2-hidden-accessible" id="selectReason" name="reason_id">
                                    <option value="0" selected>{{ __('Select the reason') }}</option>

                                    @foreach ($reason as $item)
                                        <option value="{{ $item->id }}">{{ $item->title_en }}</option>
                                    @endforeach


                                </select>
                                @error('reason')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-12  form-group">
                                <label class="form-label">{{ __('Seller') }}</label>
                                <select class="select2 select2-hidden-accessible" name="seller_id">
                                    <option value="{{ $offer->commercialActivity->seller->id }}">
                                        {{ $offer->commercialActivity->seller->firstname }}
                                        {{ $offer->commercialActivity->seller->lastname }}
                                    </option>
                                </select>
                                @error('seller_id')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-12  form-group">
                                <label class="form-label">{{ __('Price') }}</label>
                                <input class="form-control" type="text" name="price"
                                    value="{{ $offer->price }}" />
                                @error('price')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                            <div class="col-12  form-group">
                                <label class="form-label">{{ __('Discount') }}</label>
                                <input class="form-control" type="text" name="discount_rate"
                                    value="{{ $offer->discount_rate }}" />
                                @error('discount_rate')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12 form-group mg-t-8 ">
                        <label for="" class="mb-3">{{ __('Images') }}</label>

                        <div class="row">
                            @foreach (json_decode($offer->images) as $images)
                                <div class="col-md-3 m-2 div-img">
                                    <span id="del_image"
                                        data-url="{{ route('ajax.imageDestroy', [$offer->id, $loop->index]) }}"><i
                                            class="fas fa-times text-danger"></i></span>
                                    <img src="{{ asset($images) }}" style="height:100%" class="rounded" alt=""
                                        srcset="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
                        <a href="{{ route('order.offer.index') }}"
                            class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>
    </div>



@endsection
