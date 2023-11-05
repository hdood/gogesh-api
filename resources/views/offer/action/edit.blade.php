@extends('layout')
@section('title', 'offer')

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
            <div class="basic-tab">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#tab1" role="tab"
                            aria-selected="false">{{ __('Main') }}</a>
                    </li>
                    @if ($offerUpdate)
                        <li class="nav-item ">
                            <a class="nav-link " data-toggle="tab" href="#tab2" role="tab"
                                aria-selected="false">{{ __('Updated') }}</a>
                        </li>
                    @endif

                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active show " id="tab1" role="tabpanel">
                        @include('offer.partials.main')
                    </div>
                    @if ($offerUpdate)
                        <div class="tab-pane fade  " id="tab2" role="tabpanel">
                            @include('offer.partials.history')
                        </div>
                    @endif

                </div>

            </div>

        </div>
    </div>



@endsection
