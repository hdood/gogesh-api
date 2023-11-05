<?php
use App\Enum\EnumGeneral;
?>
<form class="new-added-form m-5" method="post" action="{{ route('commercialActivity.update', $commercialActivity->id) }}"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row" data-select2-id="18">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{ __('Name') }} *</label>
                    <input type="text" name="name" placeholder="" class="form-control"
                        value="{{ $commercialActivity->name }}" required>
                    @error('name')
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
                                    $phone = explode('-', $commercialActivity->phone)[2];
                                    $dial_code = explode('-', $commercialActivity->phone)[1];
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
                <div class="col-md-12 form-group">
                    <label>{{ __('Description') }} *</label>
                    <textarea class="textarea form-control" name="description" id="form-message" cols="10" rows="4">{{ $commercialActivity->description }}</textarea>
                    @error('description')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <label>{{ __('Sector') }} *</label>
                    <select class="select2 select2-hidden-accessible" name="sector_id" id="sector_id">
                        @foreach ($sectors as $sector)
                            <option value="{{ $sector->id }}" @if ($commercialActivity->sector_id == $sector->id) selected @endif>
                                @if (app()->getLocale() == 'en')
                                    {{ $sector->name_en }}
                                @else
                                    {{ $sector->name_ar }}
                                @endif

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
                        <option value="{{ $commercialActivity->activity->id }}">
                            {{ $commercialActivity->activity->getName() }}</option>

                    </select>
                    @error('activity_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <label>{{ __('Speciality') }} *</label>
                    <select class="select2 select2-hidden-accessible" name="specialization_id" id="speciality_id">
                        <option value="{{ $commercialActivity->speciality->id }}">
                            {{ $commercialActivity->speciality->getName() }}</option>

                    </select>
                    @error('specialization_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label>{{ __('Type') }} *</label>
                    <select class="select2 select2-hidden-accessible" name="type">
                        <option value="{{ EnumGeneral::PERSONAL }}" @if ($commercialActivity->type == EnumGeneral::PERSONAL) selected @endif>
                            {{ __(EnumGeneral::PERSONAL) }}
                        </option>
                        <option value="{{ EnumGeneral::COMPANY }}" @if ($commercialActivity->type == EnumGeneral::COMPANY) selected @endif>
                            {{ __(EnumGeneral::COMPANY) }}
                        </option>

                    </select>
                    @error('type')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label>{{ __('Address') }} *</label>
                    <input type="text" name="address" placeholder="" class="form-control"
                        value="{{ $commercialActivity->address }}" required>
                    @error('address')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>

                <div class="col-md-12 form-group">
                    <label>{{ __('Work Days') }} *</label>
                    <table class="table border">
                        <thead>
                            <th>{{ __('Day') }}</th>
                            <th>{{ __('From') }}</th>
                            <th>{{ __('To') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($commercialActivity->workDays() as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->from }}</td>
                                    <td>{{ $item->to }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="col-md-12 form-group">
                    <label>{{ __('Social Accounts') }} *</label>
                    @foreach (json_decode($commercialActivity->social_accounts) as $item)
                        <a href="{{ $item->url }}" class="p-3"><img
                                src="{{ asset('static/icons/social-icon') . '/' . $item->type . '.svg' }}" /></a>
                    @endforeach

                </div>
                <div class="col-md-12 form-group">
                    <label>{{ __('Season Work') }} *</label>
                    @foreach ($commercialActivity->seasons as $item)
                        <span class="badge rounded-pill bg-success text-light p-3">{{ $item->getName() }}</span>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-12  form-group">
                    <label>{{ __('Status') }} *</label>
                    <select id="editstatus" name="status" class="select2 select2-hidden-accessible">
                        <option value="">Select</option>
                        <option value="{{ EnumGeneral::APPROVED }}" @if ($commercialActivity->status == 'Approved') selected @endif>
                            {{ __(EnumGeneral::APPROVED) }}</option>
                        <option value="{{ EnumGeneral::REJECTED }}" @if ($commercialActivity->status == 'Rejected') selected @endif>
                            {{ __(EnumGeneral::REJECTED) }}</option>
                        <option value="{{ EnumGeneral::PENDING }}" @if ($commercialActivity->status == 'Pending') selected @endif>
                            {{ __(EnumGeneral::PENDING) }}</option>
                    </select>
                    @error('status')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>

                <div class="col-12 form-group" id="reason"
                    @if (!$commercialActivity->reason) style="
                    display: none;
                " @endif">
                    <label class="form-label">{{ __('Reason') }}</label>
                    <textarea class="textarea form-control" name="reason" id="form-message" cols="10" rows="4">{{ $commercialActivity->reason }}</textarea>

                    @error('reason')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-12  form-group">
                    <label class="form-label">{{ __('Seller') }}</label>
                    <select class="select2 select2-hidden-accessible" name="seller_id" id="seller">
                        <option value="{{ $commercialActivity->seller->id }}">
                            {{ $commercialActivity->seller->firstname }}
                            {{ $commercialActivity->seller->lastname }}
                        </option>
                    </select>
                    @error('seller_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                {{-- <div class="col-12  form-group">
                                <label class="form-label">{{ __('Price') }}</label>
                                <input class="form-control" type="text" name="price"
                                    value="{{ $commercialActivity->price }}" />
                                @error('price')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div> --}}
                {{-- <div class="col-12  form-group">
                                <label class="form-label">{{ __('Discount') }}</label>
                                <input class="form-control" type="text" name="discount_rate"
                                    value="{{ $commercialActivity->discount_rate }}" />
                                @error('discount_rate')
                                    <span class="text-red">{!! $message !!}</span>
                                @enderror
                            </div> --}}
                @if ($commercialActivity->logo)
                    <div class="col-md-12 form-group">
                        <label>{{ __('Logo') }}</label>
                        <img src="{{ asset($commercialActivity->logo) }}"
                            style="width: 100px;height: 100px;object-fit: cover" alt="">
                    </div>
                @endif

                @if ($commercialActivity->commercial_register)
                    <div class="col-md-12 form-group">
                        <label>{{ __('Commercial Register') }}</label>
                        <img src="{{ asset($commercialActivity->commercial_register) }}"
                            style="width: 100px;height: 100px;" alt="">
                    </div>
                @endif
                @if ($commercialActivity->commercial_signature)
                    <div class="col-md-12 form-group">
                        <label>{{ __('Commercial Signature') }}</label>
                        <img src="{{ asset($commercialActivity->commercial_signature) }}"
                            style="width: 100px;height: 100px;object-fit: cover" alt="">
                    </div>
                @endif
            </div>
        </div>

        <div class="col-12 form-group mt-5">
            <button type="submit"
                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button>
            <a href="{{ route('commercialActivity.index') }}"
                class="btn-fill-lg bg-blue-dark btn-hover-yellow">{{ __('cancel') }}</a>
        </div>
    </div>

</form>
