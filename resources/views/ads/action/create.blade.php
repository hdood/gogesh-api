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
        <h3>{{ __('Add Ads') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Add Ads') }}</li>
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
            <form class="new-added-form" method="post" action="{{ route('ads.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row" data-select2-id="18">

                    <div class="col-md-12 form-group">
                        <label>{{ __('Title') }} *</label>
                        <input type="text" name="title" placeholder="" class="form-control" value="" required>
                        @error('title')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label>{{ __('Description') }} *</label>
                        <textarea class="textarea form-control" name="description" id="form-message" cols="10" rows="4"></textarea>
                        @error('description')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('duration') }} *</label>
                        <input type="text" name="duration" placeholder="" class="form-control" value="" required>
                        @error('duration')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Date Start') }} *</label>
                        <input autocomplete="off" name="date_start" type="text" placeholder="yyyy-dd-mm"
                            class="form-control air-datepicker" data-position="bottom right" required>
                        <i class="far fa-calendar-alt"></i>
                        @error('date_start')
                            <span class="text-red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label>{{ __('price') }} *</label>
                        <input type="text" name="price" placeholder="" class="form-control" value="" required>
                        @error('price')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6  form-group">
                        <label>{{ __('place') }} *</label>
                        <select id="place" name="place" class="select2 select2-hidden-accessible" required>
                            <option value="">{{ __('Select') }}</option>
                            <option value="{{ EnumGeneral::HOME_BANER }}">{{ __(EnumGeneral::HOME_BANER) }}</option>
                            <option value="{{ EnumGeneral::HOME_FLASH }}">{{ __(EnumGeneral::HOME_FLASH) }}</option>
                            <option value="{{ EnumGeneral::SECTORS_BANER }}">{{ __(EnumGeneral::SECTORS_BANER) }}</option>
                            <option value="{{ EnumGeneral::ADS_SECREEN }}">{{ __(EnumGeneral::ADS_SECREEN) }}</option>
                            <option value="{{ EnumGeneral::SEARCH_BANER }}">{{ __(EnumGeneral::SEARCH_BANER) }}</option>
                            <option value="{{ EnumGeneral::SECTOR_FLASH }}">{{ __(EnumGeneral::SECTOR_FLASH) }}</option>
                            <option value="{{ EnumGeneral::SECTOR_BANER }}">{{ __(EnumGeneral::SECTOR_BANER) }}</option>
                            <option value="{{ EnumGeneral::NOTIFICATION }}">{{ __(EnumGeneral::NOTIFICATION) }}</option>
                        </select>
                        @error('place')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6  form-group"></div>
                    <div class="col-md-6  form-group d-none" id="sector">
                        <label>{{ __('Sector') }} *</label>
                        <select id="" name="sector_id" class="select2 select2-hidden-accessible">
                            <option value="">{{ __('Select') }}</option>
                            @foreach ($sector as $item)
                                <option value="{{ $item->id }}">{{ $item->getName() }}</option>
                            @endforeach
                        </select>
                        @error('sector_id')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-12  form-group">
                        <label>{{ __('Status') }} *</label>
                        <select id="editstatus" name="status" class="select2 select2-hidden-accessible">
                            <option value="">Select</option>
                            <option value="Approved">
                                {{ __('Approved') }}</option>
                            {{-- <option value="Rejected">
                                {{ __('Rejected') }}</option> --}}
                            <option value="PENDING">
                                {{ __('Pending') }}</option>
                        </select>
                        @error('status')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    {{-- <div class="col-12 form-group" id="reason">
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
                    </div> --}}

                    <div class="col-md-12 form-group">
                        <label class="input-group-text p-3 font-weight-bold " for="inputGroupFile01"
                            id="select_image">{{ __('Upload Image') }}</label>
                        <input type="file" name="images" id="image" accept="image/jpeg, image/png, image/jpg"
                            height="0" class="form-control position-absolute" style="top:0"
                            placeholder="
                            id=" inputGroupFile01">
                    </div>
                    <div class="col-12">
                        <output style="position: relative"></output>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="row">
                            <div class="form-check mx-3 col-md-4">
                                <input name="radio-ads" class="form-check-input" type="radio" value="option1" required>
                                <label class="form-check-label" for="bold">
                                    {{ __('Commercial Activity') }}
                                </label>
                            </div>
                            <div class="form-check mx-3 col-md-4">
                                <input name="radio-ads" class="form-check-input" type="radio" value="option2"
                                    required>
                                <label class="form-check-label" for="bold">
                                    {{ __('Ads Out') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 mb-5">
                        <div id="ads-post" class="row col-md-12">

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
                        <a href="{{ route('ads.index') }}"
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
            $("#place").change(function(e) {
                e.preventDefault();
                $('#sector select').val(null);
                if ($(this).val() == "Sector_Flash" || $(this).val() == "Sector_Baner") {
                    $("#sector").addClass('d-block');
                } else {
                    $("#sector").removeClass('d-block');
                }

            });
            $('input[type="radio"][name="radio-ads"]').change(function() {
                var selectedOption = $('input[type="radio"][name="radio-ads"]:checked').val();
                var div = $('#ads-post');

                if (selectedOption === 'option1') {
                    div.html('');
                    div.html(
                        "<label>{{ __('Seller') }} *</label><select id='seller' name='seller_id' class='select2 select2-hidden-accessible' required></select>"
                    );
                    $('#seller').select2({
                        width: '100%',
                        placeholder: 'Select an Seller',
                        ajax: {
                            url: "{{ route('ajax.autocomplete.seller') }}",
                            dataType: 'json',
                            delay: 250,
                            processResults: function(data) {
                                return {
                                    results: $.map(data, function(item) {
                                        return {
                                            text: item.firstname + " " + item.lastname,
                                            id: item.id
                                        }
                                    })
                                };
                            },
                            cache: true
                        }
                    });

                } else if (selectedOption === 'option2') {
                    div.html('');

                    div.html(
                        '<div class="col-12  form-group"><label>{{ __('Url') }} *</label><input type="text" name="url" placeholder="" class="form-control" value="" required></div>' +
                        '<div class="col-12  form-group"><label>{{ __('Postr') }} *</label><input type="text" name="poster" placeholder="" class="form-control" value="" required></div>' +
                        '<div class="col-md-12 form-group"> <label>{{ __('Type') }} *</label> <select class="select2 select2-hidden-accessible" name="poster_type"> <option value="{{ EnumGeneral::PERSONAL }}" >{{ __(EnumGeneral::PERSONAL) }}</option> <option value="{{ EnumGeneral::COMPANY }}" >{{ __(EnumGeneral::COMPANY) }}</option> </select> </div>'
                    );
                    $('.select2').select2({
                        width: '100%'
                    });
                } else {
                    div.html('');
                }
            });
        });
        var today = new Date();
        today.setDate(today.getDate() + 2);
        $('.air-datepicker').datepicker({
            minDate: today
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
                //   <span id="del_feature" onclick="deleteImage(${index})"><i class="fas fa-times text-danger"
                //                                     style="right:0"></i></span>
            })
            output.innerHTML = images
        }

        // function deleteImage(index) {
        //     imagesArray.splice(index, 1)
        //     displayImages()
        // }
    </script>

@endsection
