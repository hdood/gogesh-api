<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\Customer;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return get_class(Auth::user()) === Customer::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $userId = Auth::id();

        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:customers,email,' . $userId,
            'phone' => ['required','regex:/^.+-\+\d+-\d+$/'],
            'gender' => 'required|string',
            'country_id' => 'nullable|integer|min:0',
            'city_id' => 'nullable|integer|min:0',
            'region_id' => 'nullable|integer|min:0',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'region' => 'nullable|string',
            'image' => 'nullable|string',
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
