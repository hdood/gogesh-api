<?php
use App\Enum\EnumGeneral;
?>
<form class="new-added-form" method="post" action="{{ route('seller.update', $seller->id) }}"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row" data-select2-id="18">
        {{-- Seller --}}
        <div class="row col-12">
            <div class="col-12 py-3">
                <h3>{{ __('Seller') }}:</h3>
            </div>
            <div class="col-md-6 form-group">
                <label>{{ __('First Name') }} *</label>
                <input type="text" name="firstname" placeholder="" class="form-control"
                    value="{{ $seller->firstname }}" required>
                @error('firstname')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label>{{ __('Last Name') }} *</label>
                <input type="text" name="lastname" placeholder="" class="form-control"
                    value="{{ $seller->lastname }}" required>
                @error('lastname')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label>{{ __('Email') }} *</label>
                <input type="text" name="email" placeholder="" class="form-control" value="{{ $seller->email }}"
                    required>
                @error('email')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label>{{ __('Phone number') }} *</label>
                <div class="form-control d-flex align-items-center">
                    <select name="country_code" id=""
                        style="
                    height: 100%;
                    border: none;
                    background: transparent;
                    outline: none;
                ">
                        @php
                            try {
                                // Code that might throw an exception
                                $phone = explode('-', $seller->phone)[2];
                                $dial_code = explode('-', $seller->phone)[1];
                            } catch (\Exception $e) {
                                // Handle the exception
                                $phone = null;
                                $dial_code = null;
                            }
                        @endphp
                        @foreach ($country_code as $item)
                            <option value="{{ $item->alpha_2_code . '-' . $item->dial_code }}"
                                @if ($dial_code == $item->dial_code) selected @endif>
                                {{ $item->dial_code }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="phone" placeholder="Enter Your phone" class="form-control phone"
                        value="{{ $phone }}" required>
                    @error('phone')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12  form-group">
                <label>{{ __('gender') }} *</label>
                <select id="gender" name="gender" class="select2 select2-hidden-accessible" required>
                    <option value="">{{ __('Select') }}</option>
                    <option value="{{ EnumGeneral::MALE }}" @if ($seller->gender == EnumGeneral::MALE) selected @endif>
                        {{ __(EnumGeneral::MALE) }}</option>
                    <option value="{{ EnumGeneral::FEMALE }}" @if ($seller->gender == EnumGeneral::FEMALE) selected @endif>
                        {{ __(EnumGeneral::FEMALE) }}</option>
                </select>
                @error('gender')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>

        </div>
        {{-- Seller --}}

        {{-- Localition --}}
        <div class="row col-12">
            <div class="col-12 py-3">
                <h3>{{ __('Localition') }}:</h3>
            </div>
            <div class="col-md-4  form-group">
                <label>{{ __('Country') }} *</label>
                <select id="addCountry" name="country_id" class="select2 select2-hidden-accessible">
                    <option value="">Select</option>
                    @if ($seller->country)
                        <option value="" selected>{{ $seller->country }}</option>
                    @endif
                    @foreach ($countries as $item)
                        <option value="{{ $item->id }}" @if ($seller->country_id == $item->id) selected @endif>
                            @if (app()->getLocale() == 'en')
                                {{ $item->name_en }}
                            @else
                                {{ $item->name_ar }}
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('country_id')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-4  form-group">
                <label>{{ __('City') }} *</label>
                <select id="addCity" name="city_id" class="select2 select2-hidden-accessible">
                    <option value="">Select</option>
                    @if ($seller->city)
                        <option value="" selected>{{ $seller->city }}</option>
                    @elseif ($seller->City)
                        <option value="{{ $seller->City->id }}" selected>{{ $seller->City->getName() }}
                        </option>
                    @endif
                </select>
                @error('city_id')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-4  form-group">
                <label>{{ __('Region') }} *</label>
                <select id="addRegion" name="region_id" class="select2 select2-hidden-accessible">
                    <option value="">Select</option>
                    @if ($seller->region)
                        <option value="" selected>{{ $seller->region }}</option>
                    @elseif ($seller->Region)
                        <option value="{{ $seller->Region->id }}" selected>{{ $seller->Region->getName() }}
                        </option>
                    @endif
                </select>
                @error('region_id')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
        </div>
        {{-- Localition --}}

        {{-- Services --}}
        <div class="row col-12">
            <div class="col-12 py-3">
                <h3>{{ __('Services') }}:</h3>
            </div>
            <div class="col-md-6  form-group">
                <label>{{ __('Services') }} *</label>
                <select id="" name="services_id[]" class="select2 select2-hidden-accessible" multiple>
                    <option value="">Select</option>
                    @foreach ($services as $item)
                        <option value="{{ $item->id }}" @if (count($seller->services->where('service_id', $item->id))) selected @endif>
                            {{ $item->getName() }}
                        </option>
                    @endforeach
                </select>
                @error('services_id')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-6  form-group">
                <label>{{ __('Sections') }} *</label>
                <select id="" name="sections_id[]" class="select2 select2-hidden-accessible" multiple>
                    <option value="">Select</option>
                    @foreach ($sections as $item)
                        <option value="{{ $item->id }}" @if (count($seller->sections->where('section_id', $item->id))) selected @endif>
                            {{ $item->getName() }}
                        </option>
                    @endforeach
                </select>
                @error('sections_id')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
        </div>
        {{-- Services --}}

        {{-- Commercial Activity --}}
        <div class="row col-12 ">
            <div class="col-12 py-3">
                <h3>{{ __('Commercial Activity') }}:</h3>
            </div>
            <div class="col-md-4 form-group">
                <label>{{ __('Commercial Activity Name') }} *</label>
                <input type="text" name="commercial_activity_name" placeholder="" class="form-control"
                    value="{{ $seller->commercial_activity_name }}" required>
                @error('commercial_activity_name')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-4  form-group">
                <label>{{ __('Type Commercial Activity') }} *</label>
                <select name="type" class="select2 select2-hidden-accessible" required>
                    <option value="">Select</option>
                    <option value="{{ EnumGeneral::COMPANY }}" @if ($seller->type == EnumGeneral::COMPANY) selected @endif>
                        {{ __(EnumGeneral::COMPANY) }}</option>
                    <option value="{{ EnumGeneral::PERSONAL }}" @if ($seller->type == EnumGeneral::PERSONAL) selected @endif>
                        {{ __(EnumGeneral::PERSONAL) }}</option>
                </select>
                @error('type')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <label>{{ __('Phone number') }} *</label>
                <div class="form-control d-flex align-items-center">
                    <select name="country_code_commercial" id=""
                        style="
                    height: 100%;
                    border: none;
                    background: transparent;
                    outline: none;
                ">
                        @php
                            try {
                                // Code that might throw an exception
                                $phone = explode('-', $seller->commercial_activity_phone)[2];
                                $dial_code = explode('-', $seller->commercial_activity_phone)[1];
                            } catch (\Exception $e) {
                                // Handle the exception
                                $phone = null;
                                $dial_code = null;
                            }
                        @endphp
                        @foreach ($country_code as $item)
                            <option value="{{ $item->alpha_2_code . '-' . $item->dial_code }}"
                                @if ($dial_code == $item->dial_code) selected @endif>
                                {{ $item->dial_code }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="commercial_activity_phone" placeholder="Enter Your phone"
                        class="form-control phone" value="{{ $phone }}" required>
                    @error('commercial_activity_phone')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 form-group">
                <label>{{ __('Description') }} *</label>
                <textarea class="textarea form-control" name="commercial_activity_description" id="form-message" cols="10"
                    rows="4">{{ $seller->commercial_activity_description }}</textarea>
                @error('commercial_activity_description')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
        </div>
        {{-- Commercial Activity --}}

        {{-- Categories --}}
        <div class="row col-12 ">
            <div class="col-12 py-3">
                <h3>{{ __('Categories') }}:</h3>
            </div>
            <div class="col-md-4 form-group">
                <label>{{ __('Sector') }} *</label>
                <select class="select2 select2-hidden-accessible" name="sector_id" id="sector_id">
                    <option value="">select</option>
                    @foreach ($sectors as $item)
                        <option value="{{ $item->id }}" @if ($seller->sector_id == $item->id) selected @endif>
                            {{ $item->getName() }}</option>
                    @endforeach
                </select>
                @error('sector_id')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
            </div>
            <div class="col-md-4 form-group">

                @if ($seller->subSector)

                <label>{{ __('Sub Sector') }} *</label>
                <select class="select2 select2-hidden-accessible" name="sub_sctor_id" id="sub_sector_id">
                    <option value="{{ $seller->subSector->id }}">
                        {{ $seller->subSector->getName() }}</option>
                </select>
                @error('sub_sctor_id')
                    <span class="text-red">{!! $message !!}</span>
                @enderror

                @else 
                    Seller Does not have a sub sector
                @endif
            </div>
            <div class="col-md-4 form-group">

                @if ($seller->activity)
                    <label>{{ __('Activity') }}</label>
                    <select class="select2 select2-hidden-accessible" name="activity_id" id="activity_id">
                        <option value="{{ $seller->activity->id }}" selected>
                            {{ $seller->activity->getName() . ' # ' . $seller->activity->code }}
                        </option>
                    </select>
                    @error('activity_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                @else 
                    User does not have an activity                    
                @endif
            </div>

        </div>
        {{-- Categories --}}

        {{-- Documentation --}}
        <div class="row col-12">
            <div class="col-12 py-3">
                <h3>{{ __('Documentation') }}:</h3>
            </div>
            <div class="col-md-4 my-2 relative">
                <label style="position: absolute;right:20px">{{ __('Civil Card') }} *</label>
                <img style="width:100%;height:100%;cursor: pointer;" src="{{ asset($seller->civil_card) }}"
                    alt="">
            </div>
            @if ($seller->type == EnumGeneral::COMPANY)
                <div class="col-md-4 my-2 relative">
                    <label style="position: absolute;right:20px">{{ __('Commercial License') }} *</label>
                    <img style="width:100%;height:100%;cursor: pointer;" data-src=""
                        src="{{ asset($seller->commercial_license) }}" alt="">
                </div>
                <div class="col-md-4 my-2 relative">
                    <label style="position: absolute;right:20px">{{ __('Signature Approval') }} *</label>
                    <img style="width:100%;height:100%;cursor: pointer;"
                        src="{{ asset($seller->signature_approval) }}" alt="">
                </div>
            @endif

            {{-- <div class="col-md-4 my-2 relative">
                <label style="position: absolute;right:20px">{{ __('Logo') }} *</label>
                <img style="width:100%;height:100%;cursor: pointer;" src="{{ asset($seller->logo) }}"
                    alt="">
            </div> --}}
        </div>

        <div class="col-12 mt-5 form-group">
            <label>{{ __('Status') }} *</label>
            <select id="editstatus" name="status" class="select2 select2-hidden-accessible" required>
                <option value="">Select</option>
                @if ($seller->status == EnumGeneral::UPDATED)
                    <option value="{{ EnumGeneral::UPDATED }}" @if ($seller->status == EnumGeneral::UPDATED) selected @endif>
                        {{ __(EnumGeneral::UPDATED) }}</option>
                @endif
                @if ($seller->status == EnumGeneral::ACTIVE || $seller->status == EnumGeneral::INACTIVE)
                    <option value="{{ EnumGeneral::ACTIVE }}" @if ($seller->status == EnumGeneral::ACTIVE) selected @endif>
                        {{ __(EnumGeneral::ACTIVE) }}</option>
                    <option value="{{ EnumGeneral::INACTIVE }}" @if ($seller->status == EnumGeneral::INACTIVE) selected @endif>
                        {{ __(EnumGeneral::INACTIVE) }}</option>
                @else
                    <option value="{{ EnumGeneral::ACTIVE }}" @if ($seller->status == EnumGeneral::ACTIVE) selected @endif>
                        {{ __(EnumGeneral::ACTIVE) }}</option>
                    <option value="{{ EnumGeneral::REJECTED }}" @if ($seller->status == EnumGeneral::REJECTED) selected @endif>
                        {{ __(EnumGeneral::REJECTED) }}</option>
                    <option value="{{ EnumGeneral::PENDING }}" @if ($seller->status == EnumGeneral::PENDING) selected @endif>
                        {{ __(EnumGeneral::PENDING) }}</option>
                @endif


            </select>
            @error('status')
                <span class="text-red">{!! $message !!}</span>
            @enderror
        </div>
        <div class="col-12 form-group @if ($seller->status != EnumGeneral::REJECTED) d-none @endif" id="reason">
            <label class="form-label">{{ __('Reason') }}</label>
            <input type="text" name="reason" placeholder="" class="form-control"
                value="{{ $seller->reason }}">
            @error('reason')
                <span class="text-red">{!! $message !!}</span>
            @enderror
        </div>

        <div class="col-3 mb-3">
            <a class="btn-fill-md radius-30 bg-orange-peel p-3 bg-light text-dark" data-toggle="modal"
                data-target="#sign-up">
                {{ __('Edit Password') }}
            </a>

        </div>
        <div class="col-12 form-group mg-t-8">
            <button type="submit"
                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
            <a href="{{ route('seller.index') }}"
                class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
        </div>
    </div>

</form>
<div class="modal sign-up-modal fade" id="sign-up" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="close-btn">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="item-logo">
                    <h3>{{ __('Edit Password') }}</h3>
                </div>
                <form class="login-form">
                    <div class="row gutters-15">
                        <div class="form-group col-12">
                            <input autocomplete="off" type="password" placeholder="{{ __('New Password') }}"
                                class="form-control" id="input-password">
                        </div>
                        <div class="form-group col-12">
                            <input autocomplete="off" type="password" placeholder="{{ __('Confirme Password') }}"
                                class="form-control" id="input-confirmation">
                        </div>
                        <div class="form-group col-12">
                            <a id="update-password" data-url="{{ route('seller.updatePassword', $seller->id) }}"
                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark text-light">{{ __('Update') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
