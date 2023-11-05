<span>@extends('layout')</span>
@section('title', 'Sections')
@section('active12', 'active')
@section('menu12', 'block')
@section('menu12_a2', 'menu-active')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Sections') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('All Section') }}</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->


    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                </div>
                @can('category-create', Model::class)
                    <a href="{{ route('services.section.create') }}"
                        class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('Add Section') }}</a>
                @endcan

            </div>

            <div class="table-responsive">
                <div class="dataTables_wrapper no-footer">
                    <table class="table table-data table-activities  display  text-nowrap dataTable no-footer"
                        role="grid" data-url="{{ route('services.section.index') }}">
                        <thead>
                            <tr role="row">
                                <th data-name="id"><span>{{ __('ID') }}</span></th>
                                <th data-name="name"><span>{{ __('Name') }}</span></th>
                                <th data-name="service"><span>{{ __('Service') }}</span></th>
                                <th data-name="created_at"><span>{{ __('Created AT') }}</span></th>
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
