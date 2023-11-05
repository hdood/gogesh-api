<form action="{{ route('settings.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-6 form-group">
            <label>{{ __('Verification Account') }} *</label>
            <div class="position-relative">
                <input type="text" name="verification" placeholder="" class="form-control border"
                    value="{{ $verification }}">
                @error('question_en')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
                <span
                    style="
                                        position: absolute;
                                        top: 10px;
                                        @if (app()->getLocale() == 'en') right: 10px; @else left:10px @endif
                                    ">
                    {{ __('$') }}
                </span>
            </div>
        </div>
        <div class="col-md-6 form-group">
            <label>{{ __('Activited Commercial Activity') }} *</label>
            <div class="position-relative">
                <input type="text" name="actived" placeholder="" class="form-control border"
                    value="{{ $actived }}">
                @error('question_en')
                    <span class="text-red">{!! $message !!}</span>
                @enderror
                <span
                    style="
                        position: absolute;
                        top: 10px;
                        @if (app()->getLocale() == 'en') right: 10px; @else left:10px @endif
                    ">
                    {{ __('$') }}
                </span>
            </div>
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
