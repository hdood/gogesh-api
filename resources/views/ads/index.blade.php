@extends('layout')
@section('active5', 'active')
@section('menu5', 'block')
@section('menu5_a1', 'menu-active')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Ads') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('All Ads') }}</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->


    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                </div>
                <a href="{{ route('ads.create') }}"
                    class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('Add Ads') }}</a>

            </div>

            <div class="table-responsive">
                <div class="dataTables_wrapper no-footer">
                    <table class="table table-data table-ads  display  text-nowrap dataTable no-footer" role="grid"
                        data-url="{{ route('ads.index') }}">
                        <thead>
                            <tr role="row">
                                <th data-name="id"><span>{{ __('ID') }}</span></th>
                                <th data-name="title"><span>{{ __('Title') }}</span></th>
                                <th data-name="price"><span>{{ __('Price') }}</span></th>
                                <th data-name="date_start"><span>{{ __('Start date') }}</span></th>
                                <th data-name="date_end"><span>{{ __('End date') }}</span></th>
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
