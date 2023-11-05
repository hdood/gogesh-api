<?php
use App\Enum\EnumGeneral;
?>
<form class="new-added-form m-5" method="post"
    action="{{ route('commercialActivity.approved', $commercialActivityUpdate->commercial_activity_id) }}"
    enctype="multipart/form-data">
    @csrf
    <div class="row" data-select2-id="18">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{ __('Name') }} *</label>
                    <input type="text" name="name" placeholder="" class="form-control"
                        value="{{ $commercialActivityUpdate->name }}" disabled>
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
                                    $phone = explode('-', $commercialActivityUpdate->phone)[2];
                                    $dial_code = explode('-', $commercialActivityUpdate->phone)[1];
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
                    <textarea class="textarea form-control" name="description" id="form-message" cols="10" rows="4" disabled>{{ $commercialActivityUpdate->description }}</textarea>
                    @error('description')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <label>{{ __('Sector') }} *</label>
                    <select class="select2 select2-hidden-accessible" name="sector_id" disabled>
                        @foreach ($sectors as $sector)
                            <option>
                                {{ $commercialActivityUpdate->sector->getName() }}
                            </option>
                        @endforeach
                    </select>
                    @error('sector_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <label>{{ __('Activity') }} *</label>
                    <select class="select2 select2-hidden-accessible" name="activity_id" disabled>
                        <option value="{{ $commercialActivityUpdate->activity->id }}">
                            {{ $commercialActivityUpdate->activity->getName() }}</option>

                    </select>
                    @error('activity_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-4 form-group">
                    <label>{{ __('Speciality') }} *</label>
                    <select class="select2 select2-hidden-accessible" name="specialization_id" disabled>
                        <option value="{{ $commercialActivityUpdate->speciality->id }}">
                            {{ $commercialActivityUpdate->speciality->getName() }}</option>

                    </select>
                    @error('specialization_id')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label>{{ __('Type') }} *</label>
                    <select class="select2 select2-hidden-accessible" name="type" disabled>
                        <option value="{{ EnumGeneral::PERSONAL }}" @if ($commercialActivityUpdate->type == EnumGeneral::PERSONAL) selected @endif>
                            {{ __(EnumGeneral::PERSONAL) }}
                        </option>
                        <option value="{{ EnumGeneral::COMPANY }}" @if ($commercialActivityUpdate->type == EnumGeneral::COMPANY) selected @endif>
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
                        value="{{ $commercialActivityUpdate->address }}" disabled>
                    @error('address')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>

                {{-- <div class="col-md-12 form-group">
                    <label>{{ __('Work Days') }} *</label>
                    <table class="table border">
                        <thead>
                            <th>{{ __('Day') }}</th>
                            <th>{{ __('From') }}</th>
                            <th>{{ __('To') }}</th>
                        </thead>
                        <tbody>
                            @forelse ($commercialActivityUpdate->workDays() as $item)
                                <tr>
                                    <td>{{ $item->day }}</td>
                                    <td>{{ $item->from }}</td>
                                    <td>{{ $item->to }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>

                </div>
                <div class="col-md-12 form-group">
                    <label>{{ __('Social Accounts') }} *</label>
                    @forelse (json_decode($commercialActivityUpdate->social_accounts) as $item)
                        <a href="{{ $item->url }}" class="p-3"><img
                                src="{{ asset('static/icons/social-icon') . '/' . $item->type . '.svg' }}"
                                alt="{{ $item->url }}" /></a>
                    @empty
                    @endforelse

                </div> --}}
                <div class="col-md-12 form-group">
                    <label>{{ __('Season Work') }} *</label>
                    @foreach ($commercialActivityUpdate->seasons() as $item)
                        <span class="badge rounded-pill bg-success text-light p-3">{{ $item }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                @if ($commercialActivityUpdate->logo)
                    <div class="col-md-12 form-group">
                        <label>{{ __('Logo') }}</label>
                        <img src="{{ asset($commercialActivityUpdate->logo) }}"
                            style="width: 100px;height: 100px;object-fit: cover" alt="">
                    </div>
                @endif

                @if ($commercialActivityUpdate->commercial_register)
                    <div class="col-md-12 form-group">
                        <label>{{ __('Commercial Register') }}</label>
                        <img src="{{ asset($commercialActivityUpdate->commercial_register) }}"
                            style="width: 100px;height: 100px;" alt="">
                    </div>
                @endif
                @if ($commercialActivityUpdate->commercial_signature)
                    <div class="col-md-12 form-group">
                        <label>{{ __('Commercial Signature ') }}</label>
                        <img src="{{ asset($commercialActivityUpdate->commercial_signature) }}"
                            style="width: 100px;height: 100px;object-fit: cover" alt="">
                    </div>
                @endif

            </div>
        </div>

        <div class="col-12 form-group mt-5">
            <button type="submit"
                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('Approved') }}</button>
        </div>
    </div>

</form>
