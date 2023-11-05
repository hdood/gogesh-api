<?php
use App\Enum\EnumGeneral;
?>
@extends('layout')
@section('active5', 'active')
@section('menu5', 'block')
@section('menu5_a2', 'menu-active')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Ads') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Places Ads') }}</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->


    <div class="card height-auto">
        <div class="card-body">


            <div class="table-responsive">
                <div class="dataTables_wrapper no-footer">
                    <table class="table table-data table-ads  display  text-nowrap dataTable no-footer" role="grid"
                        data-url="{{ route('places.index') }}">
                        <thead>
                            <tr role="row">
                                <th data-name="id">{{ __('ID') }}</th>
                                <th data-name="place">{{ __('Place') }}</th>
                                <th data-name="price">{{ __('Price') }}</th>
                                <th data-name="ads">{{ __('Ads') }}</th>
                                <th data-name="status" data-filter="ai">{{ __('Status') }}</th>
                                <th data-name="action" width="0"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header" dir="ltr">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mx-1"
                                    data-dismiss="modal">{{ __('cancel') }}</button>
                                <button type="button" class="btn btn-primary"
                                    id="update_place">{{ __('save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('static/js/places.js') }}"></script>
@endsection
