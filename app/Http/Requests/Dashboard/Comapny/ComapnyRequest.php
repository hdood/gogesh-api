<?php

namespace App\Http\Requests\Dashboard\Comapny;

use Illuminate\Foundation\Http\FormRequest;

class ComapnyRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|regex:/[0-9]{9}/',
            'commercial_id' => 'required|integer',
            'activity_id' => 'required|integer|exists:activities,id',
            'seller_id' => 'required|integer|exists:sellers,id',
            'type' => 'required|integer',
            'address' => 'required',
            'description' => 'required',
            'logo' => 'required|image',
            'commercial_license' => 'required|image',
            'civil_card' => 'required|image',
            'signature_approved' => 'required|image',
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
