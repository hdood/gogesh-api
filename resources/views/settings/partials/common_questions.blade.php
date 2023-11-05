<form action="{{ route('common_questions') }}" method="POST">
    @csrf
    <output class="row col-12 m-5 ">
        @forelse ($common as $item)
            <div class="col-12 row border p-3 my-2">
                <span id="del_feature" style=""><i class="fas fa-times text-danger" style="right:0"></i></span>
                <div class="col-md-6 form-group">
                    <label>{{ __('Question Ar') }} *</label>
                    <input type="text" name="common[{{ $item->id }}][question_ar]" placeholder=""
                        class="form-control border" value="{{ $item->question_ar }}">
                    @error('question_ar')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Question En') }} *</label>
                    <input type="text" name="common[{{ $item->id }}][question_en]" placeholder=""
                        class="form-control border" value="{{ $item->question_en }}">
                    @error('question_en')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Answer Ar') }} *</label>
                    <textarea class="textarea form-control border" name="common[{{ $item->id }}][answer_ar]" id="form-message"
                        cols="10" rows="4">{{ $item->answer_ar }}</textarea>
                    @error('answer_ar')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Answer En') }} *</label>
                    <textarea class="textarea form-control border" name="common[{{ $item->id }}][answer_en]" id="form-message"
                        cols="10" rows="4">{{ $item->answer_en }}</textarea>
                    @error('answer_en')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label>{{ __('for') }} *</label>
                    <select name='common[{{ $item->id }}][for]' class='select2 select2-hidden-accessible' required>
                        <option value="All" @if ($item->for == 'All') selected @endif>{{ __('All') }}
                        </option>
                        <option value="Seller" @if ($item->for == 'Seller') selected @endif>{{ __('Seller') }}
                        </option>
                        <option value="Customer" @if ($item->for == 'Customer') selected @endif>{{ __('Customer') }}
                        </option>
                    </select>
                </div>

            </div>
        @empty
            <div class="col-12 row border p-3">
                <div class="col-md-6 form-group">
                    <label>{{ __('Question Ar') }} *</label>
                    <input type="text" name="common[0][question_ar]" placeholder="" class="form-control border"
                        value="">
                    @error('question_ar')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Question En') }} *</label>
                    <input type="text" name="common[0][question_en]" placeholder="" class="form-control border"
                        value="">
                    @error('question_en')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Answer Ar') }} *</label>
                    <textarea class="textarea form-control border" name="common[0][answer_ar]" id="form-message" cols="10"
                        rows="4"></textarea>
                    @error('answer_ar')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>{{ __('Answer En') }} *</label>
                    <textarea class="textarea form-control border" name="common[0][answer_en]" id="form-message" cols="10"
                        rows="4"></textarea>
                    @error('answer_en')
                        <span class="text-red">{!! $message !!}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label>{{ __('for') }} *</label>
                    <select name='common[0][for]' class='select2 select2-hidden-accessible' required>
                        <option value="All">{{ __('All') }}</option>
                        <option value="Seller">{{ __('Seller') }}</option>
                        <option value="Customer">{{ __('Customer') }}</option>
                    </select>
                </div>

            </div>
        @endforelse

    </output>
    <button type="button" id="add-question"
        class="m-5 mb-3 btn-fill-md radius-30 text-light bg-dark-pastel-green">{{ __('Add Question') }}
        <i class="fa-solid fa-plus">
        </i></button>
    <div class="d-flex justify-content-center" style="border: none;">
        <div class="flexbox-annotated-section-content my-4"><button type="submit"
                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">{{ __('save') }}</button></div>
    </div>
</form>
