<?php

namespace App\Http\Requests\Api\subscription;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "amount" => "required|numeric",
            "type" => "required|in:Subscription,Verification,Fees",
            "package_id" => "required_if:type,Subscription|exists:packages,id"
        ];
    }
}
