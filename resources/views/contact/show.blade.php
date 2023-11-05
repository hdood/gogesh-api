<?php

use App\Enum\EnumGeneral;

?>
@extends('layout')
@section('title', 'content')

@section('menu10_a1', 'menu-active')

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
        }

        #del_feature {
            left: 15px !important;
            padding: 0 7px !important;
        }
    </style>
@endsection
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
        <div class="row">
            <div class="col-md-9" id="contact-show">
                <div class="row  ">
                    <div class="col-12">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <span>Contact information</span>
                                </div>
                            </div>
                            <hr>
                            <div class="widget-body">
                                <p>Time: <i>{{ $contact->created_at->format('Y-m-d  h:i:s') }}</i></p>
                                <p>Full Name:
                                    <i>{{ $contact->seller ? $contact->seller->firstname . ' ' . $contact->seller->lastname : $contact->customer->firstname . ' ' . $contact->customer->lastname }}</i>
                                </p>
                                <p>Email: <i><a
                                            href="mailto:{{ $contact->seller ? $contact->seller->email : $contact->customer->email }}">{{ $contact->seller ? $contact->seller->email : $contact->customer->email }}</a></i>
                                </p>
                                <p>Phone: <i> <a
                                            href="tel:{{ $contact->seller ? $contact->seller->phone : $contact->customer->phone }}">{{ $contact->seller ? $contact->seller->phone : $contact->customer->phone }}</a>
                                    </i></p>
                                {{-- <p>Address: <i>N/A</i></p> --}}
                                <p>Subject: <i>{{ $contact->subject }}</i></p>
                                <p>Content:</p>
                                <pre class="message-content">{{ $contact->content }}</pre>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="padding: 15px;">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <span>Replies</span>
                            </div>
                        </div>
                        <hr>
                        <div class="message" id="conversation" style="border: none">
                            @forelse ($replies as $replie)
                                @if ($replie->type == get_class(Auth::user()))
                                    <div class="row message-body">
                                        <div class="col-sm-12 message-main-sender">
                                            <div class="sender">
                                                <div class="message-text"> {{ $replie->message }}</div>
                                                @if (!empty($replie->attachment))
                                                    <div class="message-text">
                                                        <img src="{{ asset($replie->attachment) }}" alt=""
                                                            srcset="">
                                                    </div>
                                                @endif
                                                <span class="message-time pull-right"> Sun </span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row message-body">
                                        <div class="col-sm-12 message-main-receiver">
                                            <div class="receiver">
                                                <div class="message-text">{{ $replie->message }}</div>
                                                @if (!empty($replie->attachment))
                                                    <div class="message-text">
                                                        <img src="{{ asset($replie->attachment) }}" alt=""
                                                            srcset="">
                                                    </div>
                                                @endif
                                                <span class="message-time pull-right"> Sun </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                {{ __('No replie Yet') }}
                            @endforelse

                        </div>
                        <output>

                        </output>

                        <div class="answer-wrapper">
                            <div class="publisher bt-1 border-light">
                                <img class="avatar avatar-xs"
                                    src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                                <input class="publisher-input" type="text" placeholder="Write something" id="message">
                                <span class="publisher-btn file-group">
                                    <i class="fa fa-paperclip file-browser" id="select_image"></i>
                                    <input type="file" id="imageFileInput">
                                </span>
                                <a class="publisher-btn text-info answer-send-button"
                                    data-url="{{ route('contact.broadcast') }}" data-id="{{ $contact->id }}"
                                    href="#" data-abc="true"><i class="fa fa-paper-plane"></i></a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body">
                                <label for="">Public</label>
                                <hr>
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark p-3"> <i
                                        class="fa fa-save"></i> {{ __('save') }}</button>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="card-body">
                                <label>{{ __('Status') }} *</label>
                                <select id="status" name="status" class="select2 select2-hidden-accessible" required>
                                    <option value="{{ EnumGeneral::READ }}"
                                        @if ($contact->status == EnumGeneral::READ) selected @endif>
                                        {{ __(EnumGeneral::READ) }}
                                    </option>
                                    <option value="{{ EnumGeneral::UNREAD }}"
                                        @if ($contact->status == EnumGeneral::UNREAD) selected @endif>
                                        {{ __(EnumGeneral::UNREAD) }}
                                    </option>
                                </select>
                                @error('place')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('static/js/chat/uplode.js') }}"></script>
    <script src="{{ asset('static/js/chat/sendChat.js') }}"></script>
@endsection
