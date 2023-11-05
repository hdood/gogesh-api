<?php

namespace App\Http\Requests\Dashboard\Package;

use App\Rules\FreePackage;
use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'max_offers' => 'required|integer',
            'offer_addition_cost' => 'required|numeric',
            'max_offer_change' => 'required|integer',
            'offer_change_cost' => 'required|numeric',
            'max_specialties' => 'required|integer',
            'specialty_addition_cost' => 'required|numeric',
            'notification_cost' => 'required|numeric',
            'max_ads_per_notification' => 'nullable|integer',
            'free_ads_duration' => 'nullable|integer',
            'features' => 'required',
            'features_ar' => 'required',
            'status' => 'required|string',
            'duration' => 'required|integer',
            'price' => ['required', 'numeric'],
            'discount_ads' => 'nullable|numeric',
            'max_users' => 'required|integer',
            'max_ads_via_sector_banner' => 'nullable|integer'

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
