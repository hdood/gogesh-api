@extends('layout')
@section('title', 'offer')

@section('active1', 'active')
@section('menu1', 'block')
@section('menu1_a1', 'menu-active')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Offers.offers') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('All Offer') }}</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->


    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">

                </div>
            </div>

            <div class="table-responsive">
                <div class="dataTables_wrapper no-footer">
                    <table class="table table-offer table-data  display  text-nowrap dataTable no-footer " role="grid"
                        data-url="{{ route('offer.index') }}">
                        <thead>
                            <tr role="row">
                                <th data-name="id"><span>{{ __('ID') }}</span></th>
                                <th data-name="title" ><span>{{ __('Title') }}</span></th>
                                <th data-name="price" ><span>{{ __('Price') }}</span></th>
                                <th data-name="sector" ><span>{{ __('Sector') }}</span></th>
                                <th data-name="created_at" ><span>{{ __('Start date') }}</span></th>
                                <th data-name="seller" ><span>{{ __('Seller') }}</span></th>
                                <th data-name="status" data-filter="apr" data-sort><span>{{ __('Status') }}</span></th>
                                <th data-name="action" width="0"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
