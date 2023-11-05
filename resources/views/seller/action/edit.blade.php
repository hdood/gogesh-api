<?php
use App\Enum\EnumGeneral;
?>
@extends('layout')
@section('title', 'sellers')
@section('menu6', 'block')

@section('active6', 'active')

@section('menu6_a1', 'menu-active')

@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Edit Seller') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Edit Seller') }}</li>
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
                    @if ($seller->upgraded)
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#tab2" role="tab"
                                aria-selected="false">{{ __('More') }}</a>
                        </li>
                    @endif
                    @if (count($seller->users))
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#tab3" role="tab"
                                aria-selected="false">{{ __('Users') }}</a>
                        </li>
                    @endif
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab1" role="tabpanel">
                        @include('seller.partials.main')
                    </div>
                    @if ($seller->upgraded)
                        <div class="tab-pane fade " id="tab2" role="tabpanel">
                            @include('seller.partials.more')

                        </div>
                    @endif
                    @if (count($seller->users))
                        <div class="tab-pane fade  " id="tab3" role="tabpanel">
                            @include('seller.partials.users')
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>



@endsection
@section('script')
    <script>
        new Cleave('.phone', {
            numeral: true,
            numeralPositiveOnly: true,
            delimiter: '',
            numeralIntegerScale: 15,
            stripLeadingZeroes: false,

            numeralThousandsGroupStyle: 'lakh'
        });
    </script>
@endsection
