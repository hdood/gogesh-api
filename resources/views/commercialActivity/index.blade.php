@extends('layout')
@section('title', 'commercial activities')

@section('active6', 'active')
@section('menu6', 'block')
@section('menu6_a2', 'menu-active')
@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Commercial Activities') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('All Commercial Activities') }}</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->


    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                </div>
            </div>

            <div class="table-responsive">
                <div class="dataTables_wrapper no-footer">
                    <table class="table table-data   display  text-nowrap dataTable no-footer"
                        data-url="{{ route('commercialActivity.index') }}" role="grid">
                        <thead>
                            <tr role="row">
                                <th data-name="id"><span>{{ __('ID') }}</span></th>
                                <th data-name="logo"><span>{{ __('Logo') }}</span></th>
                                <th data-name="name"><span>{{ __('Name') }}</span></th>
                                <th data-name="seller"><span>{{ __('Seller') }}</span></th>
                                <th data-name="created_at"><span>{{ __('Created AT') }}</span></th>
                                <th data-name="status" data-filter="apr"><span>{{ __('Status') }}</span></th>
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
