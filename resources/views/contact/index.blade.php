<?php

use App\Enum\EnumGeneral;

?>
@extends('layout')
{{-- @section('active5', 'active')
@section('menu5', 'block') --}}
@section('menu11_a1', 'menu-active')
@section('style')
    <style>
        .publisher {
            position: relative;
            display: -webkit-box;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            padding: 12px 20px;
            background-color: #f9fafb;
        }

        .publisher>*:first-child {
            margin-left: 0;
        }

        .publisher>* {
            margin: 0 8px;
        }

        .publisher-input {
            -webkit-box-flex: 1;
            flex-grow: 1;
            border: none;
            outline: none !important;
            background-color: transparent;
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: Roboto, sans-serif;
            font-weight: 300;
        }

        .publisher-btn {
            background-color: transparent;
            border: none;
            color: #8b95a5;
            font-size: 16px;
            cursor: pointer;
            overflow: -moz-hidden-unscrollable;
            -webkit-transition: .2s linear;
            transition: .2s linear;
        }

        .file-group {
            position: relative;
            overflow: hidden;
        }

        .publisher-btn {
            background-color: transparent;
            border: none;
            color: #cac7c7;
            font-size: 16px;
            cursor: pointer;
            overflow: -moz-hidden-unscrollable;
            -webkit-transition: .2s linear;
            transition: .2s linear;
        }

        .image {
            width: 100px;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        #del_image {
            left: -1px !important;
            padding: 0 7px !important;

        }


        .heading {
            height: 100%;
        }

        #contact {
            cursor: pointer;
            transition: 0.3s
        }

        #contact:hover {
            background: beige;
        }
    </style>
@endsection
@section('content')
    <div class="row"
        style="
    height: calc(100vh - 113px);
    overflow: hidden;
    margin: 20px 0;
    position: relative;
">
        <div class="col-md-3 col-12 mx-md-2 card-body p-1 py-3" style="
        height: 100%;
    ">
            <div class="heading" dir="ltr">
                <div class="row py-4 mx-0  justify-content-between align-items-center">
                    <div class="col-2">
                        <img src="{{ asset('static/img/admin.jpg') }}" class="rounded-circle" alt="" srcset="">
                    </div>
                    <div class="col-2">
                        <div class="row justify-content-center" id="make_contact" style="cursor: pointer">
                            <div class="col-sm-2 col-xs-2 heading-compose  pull-right"> <i
                                    class="fa fa-comments fa-1x  pull-right" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
                <div class="row py-4 mx-0 justify-content-center d-none" id="new_contact">
                    <div class="col-md-12 form-group">
                        <div class="row justify-content-center">
                            <div class="form-check  col-5">
                                <input name="type" class="form-check-input" type="radio" value="seller" checked
                                    required>
                                <label class="form-check-label" for="bold">
                                    {{ __('Seller') }}
                                </label>
                            </div>
                            <div class="form-check  col-5">
                                <input name="type" class="form-check-input" type="radio" value="customer" required>
                                <label class="form-check-label" for="bold">
                                    {{ __('Customer') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12 justify-content-center">
                        <div id="ads-post" class="row col-md-12">
                            <label>{{ __('Seller') }} *</label>
                            <select id='accountId' name='seller_id' class='select2 select2-hidden-accessible'
                                required></select>
                        </div>
                    </div>
                    <div class="row justify-content-center my-3">
                        <button type="button" id="create_contact" data-url="{{ route('contact.new') }}"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('Contact') }}</button>
                    </div>
                </div>

                <div class="row py-2 mx-0 ">
                    <div class="col-md-12 form-group">
                        <div class="position-relative">
                            <input type="text" name="duration" id="searchInput" placeholder=""
                                class="form-control border" value="" required="">

                            <span class="glyphicon glyphicon-search form-control-feedback"
                                style="
                            position: absolute;
                            top: 10px;
                             right: 10px;"></span>
                        </div>
                    </div>
                </div>
                <div class="contact"
                    style="

                height: 100%;
                padding-bottom: 113px
            ">
                    <div id="contacts" data-url="{{ route('new_contact') }}"
                        style="
                    overflow-y: scroll;
                    height: 100%;
                ">
                        @foreach ($data as $item)
                            <div class="media p-3" data-id="{{ $item->id }}"
                                data-url="{{ route('contact.show', $item->id) }}" id="contact">
                                <div class="item-img bg-skyblue author-online rounded-circle position-relative">
                                    @if (!empty($item->account))
                                        <img src="{{ asset($item->account->image) }}" width="50" class="rounded-circle"
                                            style="
                                        width: 50px;
                                        height: 50px;
                                    "
                                            alt="img">
                                    @else
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" width="50"
                                            class="rounded-circle" alt="img">
                                    @endif
                                    @if (count($item->unreads))
                                        <span class="position-absolute" id="active"
                                            style="
                                        left: 0;
                                        background: blue;
                                        border-radius: 50%;
                                        padding: 2px;
                                        width: 15px;
                                        height: 15px;
                                    "></span>
                                    @endif
                                </div>
                                <div class="media-body space-sm">
                                    <div class="item-title">
                                        <a class="d-flex justify-content-between ">
                                            <span class="item-name" id="contact_title">
                                                {{ $item->account->firstname . ' ' . $item->account->lastname }}
                                                <span class="text-info">{{ $item->id }}</span>
                                            </span>
                                            <span class="item-time">{{ $item->updated_at->format('h:i') }}</span>
                                        </a>
                                    </div>
                                    <p class="m-1">{{ $item->last_message }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-8 card-body messages" style="padding: 15px;height: 100%;position: relative;">
            <div class="heading-layout1">
                <div class="item-title">
                    <span class="icon-around me-3" style="cursor: pointer"><i class="far fa-arrow-alt-circle-down"
                            style="
                        transform: rotate(90deg);
                        font-size: 20px;
                    "></i></span>

                    <span class="d-flex">
                        <span id="message_title" class="mx-2">{{ __('Replies') }} </span>
                        <p id="message_title_id"></p>
                    </span>
                </div>
            </div>
            <hr>
            <div class="message" id="conversation" data-id="" data-url="" dir="ltr">

            </div>
            <div style="position: absolute;left:0;right:0;bottom: 0">
                <output>
                </output>
                <div class="answer-wrapper">
                    <div class="publisher bt-1 border-light">
                        <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png"
                            alt="...">
                        <input class="publisher-input" type="text" placeholder="{{ __('Write something') }}"
                            id="message">
                        <span class="publisher-btn file-group">
                            <i class="fa fa-paperclip file-browser" id="select_image"></i>
                            <input type="file" id="imageFileInput">
                        </span>
                        <a class="publisher-btn text-info answer-send-button" data-url="{{ route('contact.broadcast') }}"
                            data-id="" href="#" data-abc="true"><i class="fa fa-paper-plane"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('static/js/chat/uplode.js') }}"></script>
    <script src="{{ asset('static/js/chat/sendChat.js') }}"></script>
    {{-- <script src="{{ asset('static/js/chat/paginate.js') }}"></script> --}}
    <script>
        $('input[type="radio"][name="type"]').change(function() {
            var selectedOption = $('input[type="radio"][name="type"]:checked').val();
            var div = $('#ads-post');

            if (selectedOption === 'seller') {
                div.html('');
                div.html(
                    "<label>{{ __('Seller') }} *</label><select id='accountId' name='seller_id' class='select2 select2-hidden-accessible' required></select>"
                );
                $('#accountId').select2({
                    width: '100%',
                    placeholder: "{{__('Select an Seller')}}",
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

            } else if (selectedOption === 'customer') {
                div.html('');
                div.html(
                    "<label>{{ __('Customer') }} *</label><select id='accountId' name='customer_id' class='select2 select2-hidden-accessible' required></select>"
                );
                $('#accountId').select2({
                    width: '100%',
                    placeholder: "{{__('Select an Customer')}}",
                    ajax: {
                        url: "{{ route('ajax.autocomplete.customer') }}",
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

            } else {
                div.html('');
            }
        });
    </script>
    <script>
        $("#make_contact").click(function(e) {
            e.preventDefault();
            $("#new_contact").toggleClass('d-none');
            $('#accountId').select2({
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
        });
    </script>
    <script>
        $("#create_contact").click(function(e) {
            e.preventDefault();
            const url = $(this).data('url');
            const account_id = $('#accountId').val();
            const type = $('input[type="radio"][name="type"]:checked').val();

            $.post(url, {
                account_id: account_id,
                type: type,
            }).done(function(res) {
                console.log(res);
                $("#contacts").prepend(res);

                var contactElement = $(element);
                var contactID;

                $(contactElement).find("#active").remove();

                $(".messages").addClass("d-block");
                $("#message_title").text($(contactElement).find("#contact_title").text());

                const id = $(contactElement).data("id");
                const url = $(contactElement).data("url");

                $.get(url, function(data, textStatus, jqXHR) {
                    $("#conversation").empty();
                    $(".answer-send-button").data("id", id);
                    $("#conversation").data("url", url);
                    $("#conversation").data("id", id);
                    $("#conversation").append(data);
                    contactID = $("#conversation").data("id");
                    $("#conversation").scrollTop(
                        $("#conversation").prop("scrollHeight")
                    );
                }).done(function() {
                    subscribeToChannel(contactID);
                });

                page = 2;
                has_data = true;
            });
        });
    </script>
@endsection
