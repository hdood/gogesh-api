<?php
use App\Enum\EnumGeneral;
?>
@extends('layout')
@section('title', 'student')

@section('active12', 'active')
@section('menu12', 'block')
@section('menu12_a1', 'menu-active')

@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Edit Service') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Edit Service') }}</li>
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
            <form class="new-added-form" method="post" action="{{ route('services.service.update', $service->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" data-select2-id="18">

                    <div class="col-md-6 form-group">
                        <label>{{ __('Name Ar') }} *</label>
                        <input type="text" name="name_ar" placeholder="" class="form-control"
                            value="{{ $service->name_ar }}" required>
                        @error('name_ar')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('Name En') }} *</label>
                        <input type="text" name="name_en" placeholder="" class="form-control"
                            value="{{ $service->name_en }}" required>
                        @error('name_en')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-12  form-group">
                        <label>{{ __('Status') }} *</label>
                        <select id="editstatus" name="status" class="select2 select2-hidden-accessible">
                            <option value="">{{ __('Select') }}</option>
                            <option value="{{ EnumGeneral::ACTIVE }}" @if ($service->status == EnumGeneral::ACTIVE) selected @endif>
                                {{ __(EnumGeneral::ACTIVE) }}</option>
                            <option value="{{ EnumGeneral::INACTIVE }}" @if ($service->status == EnumGeneral::INACTIVE) selected @endif>
                                {{ __(EnumGeneral::INACTIVE) }}</option>
                        </select>
                        @error('status')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
                        <a href="{{ route('services.service.index') }}"
                            class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>
    </div>



@endsection
@section('script')
    <script>
        $("#image").css('opacity', '0');
        $("#image").css('width', '0');
        $("#image").css('height', '0');
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

                $("#select_image").attr("src", URL.createObjectURL(image));

                //   <span id="del_feature" onclick="deleteImage(${index})"><i class="fas fa-times text-danger"
                //                                     style="right:0"></i></span>
            })
            output.innerHTML = images
        }
    </script>
@endsection
