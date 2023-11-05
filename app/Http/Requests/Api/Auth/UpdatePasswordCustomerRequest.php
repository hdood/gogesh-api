<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return get_class(Auth::user()) == Customer::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
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
