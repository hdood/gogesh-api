<?php

namespace App\Http\Requests\Dashboard\Ads;

use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'seller_id' => 'nullable',
            'place' => "required|string",
            'duration' => "required|integer",
            'date_start' => "required|date",
            'description' => "required|string",
            'images' => "nullable|mimes:jpeg,png,jpg",
            'url' => "nullable|string",
            'poster' => "nullable|string",
            'poster_type' => "nullable|string",
            'price' => "required|numeric",
            'total' => "nullable|numeric",
            'status' => "required|string",
            'sector_id' => "nullable|integer|exists:sectors,id",
            'reason_id' => "nullable",
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
