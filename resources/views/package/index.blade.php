@extends('layout')
@section('title', 'packages')

@section('active7', 'active')
@section('menu7', 'block')
@section('menu7_a1', 'menu-active')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Packages') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('All Package') }}</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->


    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">

                </div>
                <a href="{{ route('package.create') }}"
                    class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('Add Pakage') }}</a>
            </div>

            <div class="table-responsive">
                <div class="dataTables_wrapper no-footer">
                    <table class="table table-data table-pakages  display  text-nowrap dataTable no-footer" role="grid"
                        data-url="{{ route('package.index') }}">
                        <thead>
                            <tr role="row">
                                <th data-name="id"><span>{{ __('ID') }}</span></th>
                                <th data-name="name"><span>{{ __('Name') }}</span></th>
                                <th data-name="price"><span>{{ __('Price') }}</span></th>
                                <th data-name="credits"><span>{{ __('Credits') }}</span></th>
                                <th data-name="duration"><span>{{ __('Duration') }}</span></th>
                                <th data-name="created_at"><span>{{ __('Created At') }}</span></th>
                                <th data-name="status" data-filter="ai"><span>{{ __('Status') }}</span></th>
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
