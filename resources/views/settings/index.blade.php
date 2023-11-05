@extends('layout')
@section('title', 'settings')

@section('active9', 'active')
@section('menu9', 'block')
@section('menu9_a3', 'menu-active')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>{{ __('Settings') }}</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">{{ __('home') }}</a>
            </li>
            <li>{{ __('Settings') }}</li>
        </ul>
    </div>
    <div class="card-body">
        <div class="heading-layout1 mg-b-25">


        </div>
        <div class="basic-tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item ">
                    <a class="nav-link active show" data-toggle="tab" href="#tab1" role="tab"
                        aria-selected="false">{{ __('general') }}</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " data-toggle="tab" href="#tab2" role="tab" aria-selected="true">
                        {{ __('Privacy Policy') }}</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " data-toggle="tab" href="#tab3" role="tab" aria-selected="true">
                        {{ __('Common questions') }}</a>
                </li>
            </ul>

            <div class="tab-content p-5">
                <div class="tab-pane fade active show" id="tab1" role="tabpanel">
                    @include('settings.partials.home')

                </div>
                <div class="tab-pane fade  " id="tab2" role="tabpanel">
                    @include('settings.partials.privacy_policy')
                </div>
                <div class="tab-pane fade  " id="tab3" role="tabpanel">
                    @include('settings.partials.common_questions')
                </div>
            </div>

        </div>
    </div>
    <!-- Breadcubs Area End Here -->
    <div class="card height-auto">
        <form action="http://hoskadev.net/admin/new_dashboard/settings/general" method="post" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="lA7WkmSkYdR7ewiUuH4rpDmYL4RIo0Aw7YWFFq4k">
            <div class="max-width-1200">

            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        var i = {{ count($common) }};
        $("body").on("click", "#add-question", function() {
            i++;
            $("output").append(`
            <div class="col-12 row border p-3 my-2">
                <span id="del_feature" style=""><i class="fas fa-times text-danger" style="right:0"></i></span>
            <div class="col-md-6 form-group">
                <label>{{ __('Question Ar') }} *</label>
                <input type="text" name="common[${i}][question_ar]" placeholder="" class="form-control border"
                    value="" required>
                @error('question_ar')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label>{{ __('Question En') }} *</label>
                <input type="text" name="common[${i}][question_en]" placeholder="" class="form-control border"
                    value="" required>
                @error('question_en')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label>{{ __('Answer Ar') }} *</label>
                <textarea class="textarea form-control border" name="common[${i}][answer_ar]" id="form-message" cols="10"
                    rows="4" required></textarea>
                @error('answer_ar')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label>{{ __('Answer En') }} *</label>
                <textarea class="textarea form-control border" name="common[${i}][answer_en]" id="form-message" cols="10"
                    rows="4" required></textarea>
                @error('answer_en')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-12 form-group">
                <label>{{ __('for') }} *</label>
                <select id="for-${i}" name='common[${i}][for]' class='select2 select2-hidden-accessible' required>
                    <option value="All">{{ __('All') }}</option>
                    <option value="Seller">{{ __('Seller') }}</option>
                    <option value="Customer">{{ __('Customer') }}</option>
                </select>
            </div>

        </div>
    `);
            $('#for-' + i).select2({
                width: '100%'
            })
        });
    </script>
@endsection
