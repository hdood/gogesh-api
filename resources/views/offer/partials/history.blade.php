<?php
use App\Enum\EnumGeneral;
?>
<form class="new-added-form m-5" method="post" action="{{ route('offer.approved', $offerUpdate->offer_id) }}"
    enctype="multipart/form-data">
    @csrf
    <div class="row" data-select2-id="18">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>{{ __('Title') }} *</label>
                    <input type="text" name="title" placeholder="" class="form-control"
                        value="{{ $offerUpdate->title }}" disabled>
                    @error('title')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Description') }} *</label>
                    <textarea class="textarea form-control" name="description" id="form-message" cols="10" rows="4" disabled>{{ $offerUpdate->description }}</textarea>
                    @error('description')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Condition') }} *</label>
                    <textarea class="textarea form-control" name="condition" id="form-message" cols="10" rows="4" disabled>{{ $offerUpdate->condition }}</textarea>
                    @error('condition')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                
                <div class="col-md-6 form-group">
                    <label for="organization" class="form-label">{{ __('Season') }}</label>
                    <select class="select2 select2-hidden-accessible" name="season_id" disabled>
                        <option value="">{{ __('Select') }}</option>
                        @foreach ($season as $item)
                            <option value="{{ $item->id }}" @if ($offerUpdate->season_id == $item->id) selected @endif>
                                {{ $item->season }}
                                {{ __($item->name_ar) }}
                            </option>
                        @endforeach
                    </select>
                    @error('season_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="organization" class="form-label">{{ __('Duration') }}</label>
                    <select class="select2 select2-hidden-accessible" name="duration_id" disabled>
                        @foreach ($duration as $item)
                            <option value="{{ $item->id }}" @if ($offerUpdate->duration_id == $item->id) selected @endif>
                                {{ $item->duration }}
                                {{ __($item->type) }}
                            </option>
                        @endforeach
                    </select>
                    @error('duration_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                {{-- <div class="col-md-6" form-group>
                    <label for="organization" class="form-label">{{ __('Highlight your offer title in bold') }}</label>
                    <div class="row">
                        <div class="form-check mx-3 col-md-4">
                            <input name="bold" class="form-check-input" type="radio" value="0"
                                @if ($offerUpdate->bold == 0) checked @endif disabled>
                            <label class="form-check-label" for="bold">
                                No
                            </label>
                        </div>
                        <div class="form-check mx-3 col-md-4">
                            <input name="bold" class="form-check-input" type="radio" value="1"
                                @if ($offerUpdate->bold == 1) checked @endif disabled>
                            <label class="form-check-label" for="bold">
                                Yes
                            </label>
                        </div>
                        @error('bold')
                            <span class="text-red">{!! $message !!}</span>
                        @enderror
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">

                {{-- <div class="col-12 form-group" id="reason">
                    <label class="form-label">{{ __('Reason') }}</label>
                    <select class="select2 select2-hidden-accessible" id="selectReason" name="reason_id">
                        <option value="0" selected>{{ __('Select the reason') }}</option>

                        @foreach ($reason as $item)
                            <option value="{{ $item->id }}">{{ $item->title_en }}</option>
                        @endforeach


                    </select>
                    @error('reason')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div> --}}

                <div class="col-12  form-group">
                    <label class="form-label">{{ __('Price') }}</label>
                    <input class="form-control" type="text" name="price" value="{{ $offerUpdate->price }}"
                        disabled />
                    @error('price')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-12  form-group">
                    <label class="form-label">{{ __('Discount') }}</label>
                    <input class="form-control" type="text" name="discount_rate"
                        value="{{ $offerUpdate->discount_rate }}" disabled />
                    @error('discount_rate')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label>{{ __('Reason') }} *</label>
                    <textarea class="textarea form-control" name="description" id="form-message" cols="10" rows="4" disabled>{{ $offerUpdate->reason }}</textarea>
                    @error('description')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12 form-group mg-t-8 ">
            <label for="" class="mb-3">{{ __('Images') }}</label>

            <div class="row">
                @if (!empty($offerUpdate->images))
                    @foreach (json_decode($offerUpdate->images) as $images)
                        <div class="col-md-3 m-2 div-img">

                            <img src="{{ asset($images) }}" style="height:100%" class="rounded" alt=""
                                srcset="">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @if ($offerUpdate->video)
            <div class="col-12 form-group mg-t-8 ">
                <label for="" class="mb-3">{{ __('Video') }}</label>
                <div class="row">
                    <video oncontextmenu="return false;" controls width="250" controlsList="nodownload"
                        src="{{ asset($offerUpdate->video) }}"></video>
                </div>
            </div>
        @endif
        <div class="col-12 form-group mg-t-8">
            <button type="submit"
                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('Approved') }}</button>
            <button type="button" class="modal-trigger" data-toggle="modal" data-target="#sign-up">
                {{ __('Rejected') }}
            </button>
        </div>
    </div>

</form>
<div class="modal sign-up-modal fade" id="sign-up" tabindex="-1" role="dialog" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="close-btn">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form class="login-form" action="{{ route('offer.rejectedUpdate', $offerUpdate->id) }}"
                    method="post">
                    @csrf
                    <div class="row gutters-15">
                        <div class="form-group col-12">
                            <label class="form-label">{{ __('Reason') }}</label>
                            <select class="select2 select2-hidden-accessible" name="reason_id">
                                <option value="0" selected>{{ __('Select the reason') }}</option>

                                @foreach ($reason as $item)
                                    <option value="{{ $item->id }}">{{ $item->title_en }}</option>
                                @endforeach


                            </select>
                            @error('reason')
                                <span class="text-red">{!! $message !!}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <button type="submit" class="modal-trigger" data-toggle="modal" data-target="#sign-up">
                                {{ __('Rejected') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
