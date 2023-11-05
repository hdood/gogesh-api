<?php

namespace App\Http\Requests\EmailVerfication;

use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
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
            "code"=>"required|numeric|digits:6|exists:email_verification_codes,code",
            "email"=>"required|string|exists:email_verification_codes,email",
        ];
    }
}
