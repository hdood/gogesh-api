<span>@extends('layout')</span>
@section('title', 'customers')

@section('menu4_a1', 'menu-active')

@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Customers') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('All Customers') }}</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->


    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                </div>
                @can('customer-create', Model::class)
                    <a href="{{ route('customer.create') }}"
                        class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('Add Customer') }}</a>
                @endcan

            </div>

            <div class="table-responsive">
                <div class="dataTables_wrapper no-footer">
                    <table class="table table-data table-customers  display  text-nowrap dataTable no-footer" role="grid"
                        data-url="{{ route('customer.index') }}">
                        <thead>
                            <tr role="row">
                                <th data-name="id"><span>{{ __('ID') }}</span></th>
                                <th data-name="image"><span>{{ __('Image') }}</span></th>
                                <th data-name="name"><span>{{ __('Name') }}</span></th>
                                <th data-name="email"><span>{{ __('Email') }}</span></th>
                                <th data-name="created_at"><span>{{ __('Created AT') }}</span></th>
                                <th data-name="status" data-filter="ai"> <span>{{ __('Status') }}</span></th>
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
