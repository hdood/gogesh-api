<?php

namespace App\Http\Requests\Api\Offer;

use App\Models\Seller;
use App\Models\UserCommecrialActivity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateOfferRequest extends FormRequest
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
            "total" => ['nullable', 'numeric',],
            // "bold" => "required|boolean",
            "duration_id" => "nullable|exists:duration_offers,id",
            "start_at" => "nullable|date_format:Y-m-d",
            "end_at" => "nullable|date_format:Y-m-d",
            // "speciality_id" => "required|exists:specialities,id",
            // "sector_id" => "required|exists:sectors,id",
            // "activity_id" => "required|exists:activities,id",
            // 'specialities_id' => 'required|array',
            // 'specialities_id.*' => 'exists:specialities,id',
            "season_id" => "required|exists:seasons,id",
            "images_paths" => "required_without:images|array",
            "images_paths.*" => "string",
            'images' => ['required_without:images_paths', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'video' => ['nullable', 'mimes:mp4'],
            "video_paths.*" => "nullable|array",
            'reason' => ['required', 'string'],
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
