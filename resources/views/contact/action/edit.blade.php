<?php

use App\Enum\EnumGeneral;

?>
@extends('layout')
@section('title', 'student')
@section('active5', 'active')
@section('menu5', 'block')
@section('menu5_a1', 'menu-active')


@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Edit Ads') }}</h3>
        <ul>
            <li>{{ __('Edit Ads') }}</li>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
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
            <form class="new-added-form" method="post" action="{{ route('ads.update', $ads->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" data-select2-id="18">

                    <div class="col-md-12 form-group">
                        <label>{{ __('Title') }} *</label>
                        <input type="text" name="title" placeholder="" class="form-control" value="{{ $ads->title }}"
                            required>
                        @error('title')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label>{{ __('Description') }} *</label>
                        <textarea class="textarea form-control" name="description" id="form-message" cols="10" rows="4">{{ $ads->description }}</textarea>
                        @error('description')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('duration') }} *</label>
                        <input type="text" name="duration" placeholder="" class="form-control"
                            value="{{ $ads->duration }}" required>
                        @error('duration')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Date Start') }} *</label>
                        <input name="date_start" type="text" placeholder="yyyy-dd-mm" class="form-control air-datepicker"
                            data-position="bottom right" value="{{ $ads->date_start }}" required>
                        <i class="far fa-calendar-alt"></i>
                        @error('date_start')
                            <span class="text-red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label>{{ __('price') }} *</label>
                        <input type="text" name="price" placeholder="" class="form-control"
                            value="{{ $ads->price }}" required>
                        @error('price')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6  form-group">
                        <label>{{ __('place') }} *</label>
                        <select id="place" name="place" class="select2 select2-hidden-accessible" required>
                            <option value="">{{ __('Select') }}</option>
                            <option value="1" @if ($ads->place == '1') selected @endif>{{ __('Home Page') }}
                            </option>
                            <option value="2" @if ($ads->place == '2') selected @endif>{{ __('Home Ads') }}
                            </option>
                        </select>
                        @error('place')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-12  form-group">
                        <label>{{ __('Status') }} *</label>
                        <select id="editstatus" name="status" class="select2 select2-hidden-accessible">
                            <option value="">Select</option>
                            <option value="Approved" @if ($ads->status == EnumGeneral::APPROVED) selected @endif>
                                {{ __('Approved') }}</option>
                            <option value="Rejected" @if ($ads->status == EnumGeneral::REJECTED) selected @endif>
                                {{ __('Rejected') }}</option>
                            <option value="PENDING" @if ($ads->status == EnumGeneral::PENDING) selected @endif>
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

                    <div class="col-md-12 form-group">
                        <label class="input-group-text p-3 font-weight-bold " for="inputGroupFile01"
                            id="select_image">{{ __('Upload Image') }}</label>
                        {{-- <input type="file" id="image" accept="image/jpeg, image/png, image/jpg" class="form-control"> --}}
                        <input type="file" name="images" id="image" accept="image/jpeg, image/png, image/jpg"
                            height="0" class="form-control position-absolute" style="top:0"
                            placeholder="
                            id=" inputGroupFile01">
                    </div>
                    <div class="col-12">
                        <output style="position: relative">
                            <div class="image">
                                <img src="{{ asset($ads->images) }}" alt="image">
                            </div>
                        </output>
                    </div>

                    <div class="row col-12 mb-5">

                        @if ($ads->seller_id)
                            <div class="col-12  form-group" id="ads-post">
                                <label>{{ __('Seller') }} *</label>
                                <select id='seller' name='seller_id' class='select2 select2-hidden-accessible' required>
                                    <option value="{{ $ads->seller_id }}">
                                        {{ $ads->seller->firstname . ' ' . $ads->seller->lastname }}</option>
                                </select>
                            </div>
                        @elseif($ads->url)
                            <div class="col-12  form-group" id="ads-post">
                                <label>{{ __('Url') }} *</label><input type="text" name="url" placeholder=""
                                    class="form-control" value="{{ $ads->url }}" required>

                            </div>
                            <div class="col-12  form-group"><label>{{ __('Postr') }} *</label><input type="text"
                                    name="poster" placeholder="" class="form-control" value="{{ $ads->poster }}"
                                    required>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>{{ __('Type') }} *</label>
                                <select class="select2 select2-hidden-accessible" name="poster_type">
                                    <option value="{{ EnumGeneral::PERSONAL }}"
                                        @if ($ads->poster_type == EnumGeneral::PERSONAL) selected @endif>
                                        {{ __(EnumGeneral::PERSONAL) }}
                                    </option>
                                    <option value="{{ EnumGeneral::COMPANY }}"
                                        @if ($ads->poster_type == EnumGeneral::COMPANY) selected @endif>
                                        {{ __(EnumGeneral::COMPANY) }}
                                    </option>

                                </select>
                                @error('type')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    @error('seller')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror

                    @error('url')
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
        $(document).ready(function() {
            $('#seller').select2({
                width: '100%',
                placeholder: 'Select an Seller',
                ajax: {
                    url: "{{ route('ajax.autocomplete') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.firstname,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>

    <script>
        $("#image").css('opacity', '0');
        $("#select_image").click(function(e) {
            e.preventDefault();
            $("#image").trigger('click');
        });
        const input = document.querySelector("#image")
        const output = document.querySelector("output")
        let imagesArray = []
        input.addEventListener("change", () => {
            const file = input.files
            imagesArray = []
            imagesArray.push(file[0])
            displayImages()
        })

        function displayImages() {
            let images = ""
            imagesArray.forEach((image, index) => {
                images = `<div class="image">
                <img src="${URL.createObjectURL(image)}" alt="image">
              </div>`
            })
            output.innerHTML = images
        }
    </script>

@endsection
