@extends('layout')
@section('menu4_a1', 'menu-active')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Orders') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Customer Order') }}</li>
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
                    <table class="table  table-data table-orderOffer  display  text-nowrap dataTable no-footer "
                        role="grid" data-url="{{ route('order.customer.index') }}">
                        <thead>
                            <tr role="row">
                                <th data-name="id"><span>{{ __('ID') }}</span></th>
                                <th data-name="offer_id"><span>{{ __('Offer Id') }}</span></th>
                                <th data-name="offer_title"><span>{{ __('Offer Title') }}</span></th>
                                <th data-name="customer_name"><span>{{ __('Customer') }}</span></th>
                                <th data-name="created_at"><span>{{ __('Data created') }}</span></th>
                                <th data-name="action"></th>
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
