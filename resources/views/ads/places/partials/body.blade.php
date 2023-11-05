<?php
use App\Enum\EnumGeneral;
?>
<div class="col-12  form-group">
    <label>{{ __('Status') }} *</label>
    <select id="status" name="status" data-id="{{$place->id}}" data-url="{{ route('places.update', $place->id) }}"
        class="select2 select2-hidden-accessible">
        <option value="">Select</option>
        <option value="{{ EnumGeneral::ACTIVE }}" @if ($place->status == EnumGeneral::ACTIVE) selected @endif>
            {{ __(EnumGeneral::ACTIVE) }}</option>
        <option value="{{ EnumGeneral::INACTIVE }}" @if ($place->status == EnumGeneral::INACTIVE) selected @endif>
            {{ __(EnumGeneral::INACTIVE) }}</option>
    </select>
</div>
<div class="col-md-12 form-group">
    <label>{{ __('Price') }} *</label>
    <input type="text" name="price" id="price" placeholder="" class="form-control border"
        value="{{ $place->price }}" required>
</div>
