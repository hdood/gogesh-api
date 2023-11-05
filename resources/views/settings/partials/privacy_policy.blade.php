<form action="{{ route('settings.privacy_policy') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <h3>{{ __('Privacy Policy') }}:</h3>

        </div>
        <div class="col-md-12 form-group">
            <label>{{ __('English') }} *</label>
            <textarea class="textarea form-control" name="privacy_policy" id="form-message" cols="10" rows="4">{{ $privacy_policy->value }}</textarea>
            @error('privacy_policy')
                <span class="text-red">{!! $message !!}</span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            <label>{{ __('Arabic') }} *</label>
            <textarea class="textarea form-control" name="privacy_policy_ar" id="form-message" cols="10" rows="4">{{ $privacy_policy->value_ar }}</textarea>
            @error('privacy_policy_ar')
                <span class="text-red">{!! $message !!}</span>
            @enderror
        </div>

        <div class="d-flex justify-content-center " style="border: none;width: 100%">
            <div class="flexbox-annotated-section-annotation">
                &nbsp;
            </div>
            <div class="flexbox-annotated-section-content my-4"><button type="submit"
                    class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button></div>
        </div>
    </div>
</form>
