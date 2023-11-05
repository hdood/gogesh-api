<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiFormRequest;

class SellerUpgradeRequest extends ApiFormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'logo' => [
                'required',
                'mimes:png,jpg,jpeg'
            ],

            'specialities_id' => 'required|array',
            'specialities_id.*' => 'exists:specialities,id',

            'seasons_id' => 'required|array',
            'seasons_id.*' => 'exists:seasons,id',

            "work_days" => "required|array",
            "work_days.*.day" => "required|exists:days,id",
            "work_days.*.from" => "required|string",
            "work_days.*.to" => "required|string",

            'social_accounts' => 'required|array',
            'social_accounts.*.name' => 'required|string',
            'social_accounts.*.url' => 'required|string',
            'social_accounts.*.type' => 'required|string',
            'delivery_price' => 'nullable|numeric'
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
