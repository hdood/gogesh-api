@extends('layout')
@section('title', 'transactions')

@section('active10', 'active')
@section('menu10', 'block')
@section('menu10_a1', 'menu-active')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Transactions') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('All Transaction') }}</li>
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
                    <table class="table table-data table-transactions  display  text-nowrap dataTable no-footer"
                        role="grid" data-url="{{ route('payment.transaction.index') }}">
                        <thead>
                            <tr role="row">
                                <th data-name="id"><span>{{ __('ID') }}</span></th>
                                <th data-name="seller_id"><span>{{ __('Seller Id') }}</span></th>
                                <th data-name="seller_name"><span>{{ __('Seller Name') }}</span></th>
                                <th data-name="amount"><span>{{ __('Amount') }}</span></th>
                                <th data-name="method_name"><span>{{ __('Method Name') }}</span></th>
                                <th data-name="type"><span>{{ __('Type Transaction') }}</span></th>
                                <th data-name="created_at"><span>{{ __('Created AT') }}</span></th>
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
