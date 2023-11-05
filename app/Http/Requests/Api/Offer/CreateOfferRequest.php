<?php

namespace App\Http\Requests\Api\Offer;

use App\Models\Seller;
use App\Models\UserCommecrialActivity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return get_class(Auth::user()) === Seller::class || get_class(Auth::user()) === UserCommecrialActivity::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => ['required', 'string', 'max:20'],
            "description" => ['required', 'string', 'max:200'],
            "condition" => ['required', 'string', 'max:200'],
            'price' => ['required', 'numeric',],
            'discount' => ['required', 'numeric', 'between:0,100'],
            "total" => ['required', 'numeric',],
            "duration_id" => "nullable|exists:duration_offers,id",
            "start_at"=>"nullable|date_format:Y-m-d",
            "end_at"=>"nullable|date_format:Y-m-d",
            // "bold" => "required|boolean",
            // "sector_id" => "required|exists:sectors,id",
            // "activity_id" => "required|exists:activities,id",
            'specialities_id' => 'required|array',
            'specialities_id.*' => 'exists:specialities,id',
            "season_id" => "required|exists:seasons,id",
            'video' => ['nullable', 'mimes:mp4'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }
    public function attributes(): array
    {
        $rules = [];
        foreach ($this->rules() as $key => $rule) {
            $rules[$key] = __('attributes.' . $key);
        }
        return $rules;
    }
}
