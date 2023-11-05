<?php

use App\Enum\EnumGeneral;

?>
<form class="new-added-form m-5" method="post" action="{{ route('offer.update', $offer->id) }}"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row" data-select2-id="18">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>{{ __('Title') }} *</label>
                    <input type="text" name="title" placeholder="" class="form-control" value="{{ $offer->title }}"
                        required>
                    @error('title')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Description') }} *</label>
                    <textarea class="textarea form-control" name="description" id="form-message" cols="10" rows="4">{{ $offer->description }}</textarea>
                    @error('description')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Condition') }} *</label>
                    <textarea class="textarea form-control" name="condition" id="form-message" cols="10" rows="4">{{ $offer->condition }}</textarea>
                    @error('condition')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Date Start') }} *</label>
                    <input name="start_at" type="text" placeholder="yyyy-dd-mm" class="form-control air-datepicker"
                        @if (app()->getLocale() == 'ar') style="padding: 0 40px" @endif data-position="bottom right"
                        value="{{ $offer->start_at }}" required>
                    <i class="far fa-calendar-alt"></i>
                    @error('start_at')
                        <span class="text-red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Date End') }} *</label>

                    <input name="end_at" type="text" placeholder="yyyy-dd-mm" class="form-control air-datepicker"
                        @if (app()->getLocale() == 'ar') style="padding: 0 40px" @endif data-position="bottom right"
                        value="{{ $offer->end_at }}" required>
                    <i class="far fa-calendar-alt"></i>
                    @error('end_at')
                        <span class="text-red">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="col-md-4 form-group">
                    <label>{{ __('Sector') }} *</label>
                    <select class="select2 select2-hidden-accessible" name="sector_id" id="sector_id">
                        @foreach ($sectors as $sector)
                            <option value="{{ $sector->id }}" @if ($offer->sector_id == $sector->id) selected @endif>
                                {{ $sector->getName() }}
                            </option>
                        @endforeach
                    </select>
                    @error('sector_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <label>{{ __('Activity') }} *</label>
                    <select class="select2 select2-hidden-accessible" name="activity_id" id="activity_id">
                        <option value="{{ $offer->activity_id }}">{{ $offer->activity->getName() }}</option>
                    </select>
                    @error('activity_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <label>{{ __('speciality') }} *</label>
                    <select class="select2 select2-hidden-accessible" name="speciality_id" id="speciality_id">
                        <option value="{{ $offer->speciality_id }}">{{ $offer->speciality->getName() }}
                        </option>

                    </select>
                    @error('speciality_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div> --}}
                <div class="col-md-6 form-group">
                    <label for="organization" class="form-label">{{ __('Season') }}</label>
                    <select class="select2 select2-hidden-accessible" name="season_id">
                        <option value="">{{ __('Select') }}</option>
                        @foreach ($season as $item)
                            <option value="{{ $item->id }}" @if ($offer->season_id == $item->id) selected @endif>
                                {{ $item->season }}
                                {{ __($item->getName()) }}
                            </option>
                        @endforeach
                    </select>
                    @error('season_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="organization" class="form-label">{{ __('Duration') }}</label>
                    <select class="select2 select2-hidden-accessible" name="duration_id">
                        <option value="">{{ __('Select') }}</option>
                        @foreach ($duration as $item)
                            <option value="{{ $item->id }}" @if ($offer->duration_id == $item->id) selected @endif>
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
                                @if ($offer->bold == 0) checked @endif>
                            <label class="form-check-label" for="bold">
                                No
                            </label>
                        </div>
                        <div class="form-check mx-3 col-md-4">
                            <input name="bold" class="form-check-input" type="radio" value="1"
                                @if ($offer->bold == 1) checked @endif>
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
                <div class="col-12  form-group">
                    <label>{{ __('Status') }} *</label>
                    <select id="editstatus" name="status" class="select2 select2-hidden-accessible">
                        <option value="">Select</option>
                        @if ($offer->status == EnumGeneral::UPDATED)
                            <option value="{{ EnumGeneral::UPDATED }}"
                                @if ($offer->status == EnumGeneral::UPDATED) selected @endif>
                                {{ __(EnumGeneral::UPDATED) }}</option>
                        @else
                            @if ($offer->status == EnumGeneral::APPROVED || $offer->status == EnumGeneral::DRAFT)
                                <option value="Approved" @if ($offer->status == 'Approved') selected @endif>
                                    {{ __('Approved') }}</option>
                                <option value="{{ EnumGeneral::DRAFT }}"
                                    @if ($offer->status == EnumGeneral::DRAFT) selected @endif>
                                    {{ __(EnumGeneral::DRAFT) }}</option>
                            @else
                                <option value="{{ EnumGeneral::APPROVED }}"
                                    @if ($offer->status == EnumGeneral::APPROVED) selected @endif>
                                    {{ __(EnumGeneral::APPROVED) }}</option>
                                <option value="{{ EnumGeneral::PENDING }}"
                                    @if ($offer->status == EnumGeneral::PENDING) selected @endif>
                                    {{ __(EnumGeneral::PENDING) }}</option>
                                <option value="{{ EnumGeneral::REJECTED }}"
                                    @if ($offer->status == EnumGeneral::REJECTED) selected @endif>
                                    {{ __(EnumGeneral::REJECTED) }}</option>
                            @endif


                        @endif

                    </select>
                    @error('status')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-12 form-group @if ($offer->status != EnumGeneral::REJECTED) d-none @endif" id="reason">
                    <label class="form-label">{{ __('Reason') }}</label>
                    <select class="select2 select2-hidden-accessible" id="selectReason" name="reason_id">
                        <option value="" selected>{{ __('Select the reason') }}</option>

                        @foreach ($reason as $item)
                            <option value="{{ $item->id }}" @if ($offer->reason_id == $item->id) selected @endif>
                                {{ $item->title_en }}</option>
                        @endforeach


                    </select>
                    @error('reason')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-12  form-group">
                    <label class="form-label">{{ __('Seller') }}</label>
                    <select class="select2 select2-hidden-accessible" name="seller_id" id="seller">
                        <option value="{{ $offer->seller_id }}">
                            {{ $offer->seller->firstname . ' ' . $offer->seller->lastname }}
                        </option>
                    </select>
                    @error('seller_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-12  form-group">
                    <label class="form-label">{{ __('Price') }}</label>
                    <input class="form-control" type="text" name="price" value="{{ $offer->price }}" />
                    @error('price')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-12  form-group">
                    <label class="form-label">{{ __('Discount') }}</label>
                    <input class="form-control" type="text" name="discount_rate"
                        value="{{ $offer->discount_rate }}" />
                    @error('discount_rate')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12 form-group mg-t-8 ">
            <label for="" class="mb-3">{{ __('Images') }}</label>

            <div class="row">
                @if (!empty($offer->images))
                    @foreach (json_decode($offer->images) as $images)
                        <div class="col-md-3 m-2 div-img">
                            <span id="del_image"
                                data-url="{{ route('ajax.imageDestroy', [$offer->id, $loop->index]) }}"><i
                                    class="fas fa-times text-danger"></i></span>
                            <img src="{{ asset($images) }}" style="height:100%" class="rounded" alt=""
                                srcset="">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @if ($offer->video)
            <div class="col-12 form-group mg-t-8 ">
                <label for="" class="mb-3">{{ __('Video') }}</label>
                <div class="row">
                    <video oncontextmenu="return false;" controls width="250" controlsList="nodownload"
                        src="{{ asset($offer->video) }}"></video>
                </div>
            </div>
        @endif
        <div class="col-12 form-group mg-t-8">
            <button type="submit"
                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
            <a href="{{ route('offer.index') }}"
                class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
        </div>
    </div>

</form>
