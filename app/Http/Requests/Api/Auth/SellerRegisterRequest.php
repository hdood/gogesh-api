<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class SellerRegisterRequest extends ApiFormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email|unique:sellers',
            'phone' => [
                'required',
                'regex:/^.+-\+\d+-\d+$/'

            ],

            "gender" => "required",

            'city_id' => 'nullable|exists:cities,id',
            'region_id' => 'nullable|exists:regions,id',
            'country_id' => 'nullable|exists:countries,id',

            'country' => "nullable|string",
            'city' => "nullable|string",
            'region' => "nullable|string",

            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers(),
                'string',
                'confirmed',
            ],
            // 'image' => ['nullable', File::types(['png', 'jpg', 'jpeg'])],

            'services_id' => 'required|array',
            'services_id.*' => 'exists:services,id',
            'sections_id' => 'required|array',
            'sections_id.*' => 'exists:sections,id',

            'type' => 'required|in:Company,Personal',
            'commercial_activity_name' => 'required|string',
            'commercial_activity_description' => 'required|min:20',
            'commercial_activity_phone' => [
                'required',
                'regex:/^.+-\+\d+-\d+$/'

            ],

            'sector_id' => 'required|exists:sectors,id',
            'sub_sector_id' => 'required|exists:sub_sectors,id',
            'activity_id' => 'required|exists:activities,id',


            'civil_card' => [
                'required',
                'mimes:png,jpg,jpeg,pdf'
            ],
            'commercial_license' =>  [
                'required_if:type,Company',
                'mimes:png,jpg,jpeg,pdf'
            ],
            'signature_approval' =>  [
                'required_if:type,Company',
                'mimes:png,jpg,jpeg,pdf'
            ],

            'fcm_token' => ['required', 'string'],


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
