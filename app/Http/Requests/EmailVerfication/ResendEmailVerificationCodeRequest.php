<?php

namespace App\Http\Requests\EmailVerfication;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class ResendEmailVerificationCodeRequest extends FormRequest
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
            "type" => [
                'required',
                Rule::in(['sellers', 'customers',]),
            ],
            "email"=> ["required",Rule::unique(Request::input('type'), 'email'),]
        ];
    }
}
