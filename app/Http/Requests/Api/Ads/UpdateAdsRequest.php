<?php

namespace App\Http\Requests\Api\Ads;

use App\Models\Seller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAdsRequest extends FormRequest
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
            "title" => "required",
            'place' => "required|string",
            'description' => "required|string",
            'duration' => "required|exists:duration_offers,id",
            'date_start' => "required|date",
            'images' => "required_without:images_paths|mimes:jpeg,png,jpg",
            'images_paths' => "required_without:images|mimes:jpeg,png,jpg",
            'price' => "required|numeric",
            'total' => "required|numeric",
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
