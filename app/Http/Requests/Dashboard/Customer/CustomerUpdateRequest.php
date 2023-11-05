<?php

namespace App\Http\Requests\Dashboard\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class CustomerUpdateRequest extends FormRequest
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
        $userId = $this->route('customer');
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:customers,email,' . $userId,
            'phone' => 'required|regex:/[0-9]{9}/',
            'country_code' => 'required|string',
            'gender' => 'required|string',
            'status' => 'required|string',
            'country_id' => 'nullable|integer|min:0',
            'city_id' => 'nullable|integer|min:0',
            'region_id' => 'nullable|integer|min:0',
            'image' => 'nullable|string',
            'password' => [
                'nullable',
                Password::min(8)
                    ->mixedCase()
                    ->numbers(),
                'confirmed',
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
