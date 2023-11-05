@extends('layout')
@section('title', 'roles')

@section('active9', 'active')
@section('menu9', 'block')

@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('edit Role') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('edit Role') }}</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto" data-select2-id="21">
        <div class="card-body" data-select2-id="20">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>{{ __('add new') }}</h3>
                </div>

            </div>
            <form class="new-added-form" method="post" action="{{ route('role.update', $role->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row" data-select2-id="18">

                    <div class="col-md-12 form-group">
                        <label>{{ __('Name') }} *</label>
                        <input type="text" name="name" placeholder="" class="form-control" value="{{ $role->name }}"
                            required>
                        @error('name')
                            <span class="text-red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12  form-group">
                        <label>{{ __('Permission') }} *</label>
                        <select id="city" name="permission_id[]" class="select2 select2-hidden-accessible" multiple>
                            <option value="">Select</option>
                            @foreach ($permissions as $item)
                                <option value="{{ $item->id }}" @if (isset($rolePermissions[$item->id])) Selected @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('permission_id')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
                        <a href="{{ route('role.index') }}"
                            class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>
    </div>



@endsection
