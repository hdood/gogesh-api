<?php
use App\Enum\EnumGeneral;
?>
<div>
    <div class="row">
        <div class="col-12 py-3">
            <h3>{{ __('Seller') }}:</h3>
        </div>
        <div class="col-md-6  form-group">
            <label>{{ __('specialities') }} *</label>
            <select name="specialities_id[]" class="select2 select2-hidden-accessible" multiple>
                <option value="">Select</option>

                @foreach ($specialities as $item)
                    <option value="{{ $item->id }}" @if (count($seller->specialities->where('speciality_id', $item->id))) selected @endif>
                        {{ $item->getName() }}
                    </option>
                @endforeach
            </select>
            @error('specialities_id')
                <span class="text-red">{!! $message !!}</span>
            @enderror
        </div>
        <div class="col-md-6  form-group">
            <label>{{ __('seasons') }} *</label>
            <select name="seasons_id[]" class="select2 select2-hidden-accessible" multiple>
                <option value="">Select</option>

                @foreach ($seasons as $item)
                    <option value="{{ $item->id }}" @if (count($seller->seasons->where('season_id', $item->id))) selected @endif>
                        {{ $item->getName() }}
                    </option>
                @endforeach
            </select>
            @error('seasons_id')
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
                    @forelse ($seller->workDays() as $item)
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
            @forelse (json_decode($seller->social_accounts) as $item)
                <a href="{{ $item->url }}" class="p-3"><img
                        src="{{ asset('static/icons/social-icon') . '/' . $item->type . '.svg' }}"
                        alt="{{ $item->url }}" /></a>
            @empty
            @endforelse

        </div>
        <div class="col-md-6 form-group">
            <label>{{ __('delivery') }} *</label>
            <select name="delivery" class="select2 select2-hidden-accessible" required>
                <option value="">Select</option>
                <option value="1" @if ($seller->delivery == 1) selected @endif>
                    {{ __(EnumGeneral::ACTIVE) }}</option>
                <option value="0" @if ($seller->delivery == 0) selected @endif>
                    {{ __(EnumGeneral::INACTIVE) }}</option>
            </select>
            @error('delivery')
                <span class="text-red">{!! $message !!}</span>
            @enderror
        </div>
        <div class="col-md-6 form-group">
            <label>{{ __('Delivery Price') }} *</label>
            <input type="text" name="delivery_price" placeholder="" class="form-control"
                value="{{ $seller->delivery_price }}" style="height: 50px !important;" required>
            @error('delivery_price')
                <span class="text-red">{!! $message !!}</span>
            @enderror
        </div>

        @if ($seller->upgraded_status == EnumGeneral::PENDING)
            <div class="col-12 form-group mg-t-8">
                <a href="{{ route('approvedUpgrad', $seller->id) }}"
                    class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('Approved Upgrade') }}</a>
            </div>
        @endif

    </div>

</div>
