@extends('layout')
{{-- @section('active5', 'active')
@section('menu5', 'block') --}}
@section('menu10_a1', 'menu-active')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Contact') }}</h3>
        <ul>
            <li>{{ __('All Contact') }}</li>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->


    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                </div>
                {{-- <a href="{{ route('ads.create') }}"
                    class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('Add Ads') }}</a> --}}
            </div>

            <div class="table-responsive">
                <div class="dataTables_wrapper no-footer">
                    <table class="table table-data table-ads  display  text-nowrap dataTable no-footer" role="grid"
                        data-url="{{ route('contact.index') }}">
                        <thead>
                            <tr role="row">
                                <th data-name="id">{{ __('ID') }}</th>
                                <th data-name="name">{{ __('Name') }}</th>
                                <th data-name="subject">{{ __('Subject') }}</th>
                                <th data-name="email">{{ __('Email') }}</th>
                                <th data-name="created_at">{{ __('Created At') }}</th>
                                <th data-name="status">{{ __('Status') }}</th>
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
