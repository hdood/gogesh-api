<span>@extends('layout')</span>
@section('active1', 'active')
@section('menu1', 'block')
@section('menu1_a4', 'menu-active')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Orders') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('All Order') }}</li>
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
                    <table class="table table-orderOffer table-data  display  text-nowrap dataTable no-footer " role="grid"
                        data-url="{{ route('order.offer.index') }}">
                        <thead>
                            <tr role="row">
                                <th data-name="id"><span>{{ __('ID') }}</span></th>
                                <th data-name="offer_id"><span>{{ __('Offer Id') }}</span></th>
                                <th data-name="offer_title"><span>{{ __('Offer Title') }}</span></th>
                                <th data-name="customer_name"><span>{{ __('Customer') }}</span></th>
                                {{-- <th>{{ __('Seller') }}</th> --}}
                                <th data-name="created_at"><span>{{ __('Data created') }}</span></th>
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
