<?php

namespace App\Http\Requests\Dashboard\Seller;

use Illuminate\Foundation\Http\FormRequest;

class SellerUpdateRequest extends FormRequest
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

        $userId = $this->route('seller');
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:sellers,email,' . $userId,
            'phone' => 'required|regex:/[0-9]{9}/',
            'country_code' => 'required|string',
            'gender' => 'required|string',
            'status' => 'required|string',
            'country_id' => 'nullable|integer|min:0',
            'city_id' => 'nullable|integer|min:0',
            'region_id' => 'nullable|integer|min:0',
            'services_id' => 'required|array',
            'services_id.*' => 'required|integer|exists:services,id',
            'sections_id' => 'nullable|array',
            'sections_id.*' => 'nullable|integer|exists:sections,id',
            'image' => 'nullable|string',
            'commercial_activity_name'=>'required',
            'commercial_activity_phone' => 'required|regex:/[0-9]{9}/',
            'country_code_commercial' => 'required|string',
            'sector_id' => 'required|integer',
            'sub_sctor_id' => 'required|integer',
            'activity_id' => 'required|integer|exists:activities,id',
            'type' => 'required|string',
            // 'address' => 'required',
            'commercial_activity_description' => 'required',
            'reason' => 'nullable|string',
        ];
    }
}
