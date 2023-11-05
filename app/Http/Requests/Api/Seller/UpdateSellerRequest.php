<?php

namespace App\Http\Requests\Api\Seller;

use App\Models\Seller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSellerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return get_class(Auth::user()) === Seller::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $userId = Auth::id();
        return [
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email|unique:sellers,email,' . $userId,
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

            // 'image' => ['nullable', File::types(['png', 'jpg', 'jpeg'])],

            'services_id' => 'required|array',
            'services_id.*' => 'exists:services,id',
            'sections_id' => 'required|array',
            'sections_id.*' => 'exists:sections,id',

            'commercial_activity_name' => 'required|string',
            'commercial_activity_description' => 'required|min:20',
            'commercial_activity_phone' => [
                'required',
                'regex:/^.+-\+\d+-\d+$/'
            ],

            'sector_id' => 'required|exists:sectors,id',
            'sub_sector_id' => 'required|exists:sub_sectors,id',
            'activity_id' => 'required|exists:activities,id',

            'reason_update' => "required|string",

            'civil_card' => [
                'nullable',
                'mimes:png,jpg,jpeg,pdf'
            ],
            'commercial_license' =>  [
                'nullable',
                'mimes:png,jpg,jpeg,pdf'
            ],
            'signature_approval' =>  [
                'nullable',
                'mimes:png,jpg,jpeg,pdf'
            ],
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
