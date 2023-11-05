<?php

namespace App\Http\Requests\Api\Company;

use App\Models\Seller;
use App\Rules\ScheduleRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class CreateCommercialActivityRequest extends FormRequest
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
        return [
            'seasons' => 'required|array',
            'seasons.*' => 'exists:seasons,id',
            'specialization_id' => 'required|exists:specialities,id',
            'seller_id' => 'required|exists:sellers,id|unique:commercial_activity,seller_id',
            'sector_id' => 'required|exists:sectors,id',
            'activity_id' => 'required|exists:activities,id',
            'social_accounts' => 'required|array',
            'social_accounts.*.name' => 'required|string',
            'social_accounts.*.url' => 'required|string',
            'social_accounts.*.type' => 'required|string',
            'type' => 'required|in:Company,Personal',
            'name' => 'required|min:5',
            'phone' => 'required|regex:/[0-9]{9}/',
            'description' => 'required|min:20',
            'delivery' => 'required|boolean',
            'delivery_value' => 'required_if:delivery,true|numeric',
            "address" => "required|string",
            "work_days" => "required|array",
            "work_days.*.day" => "required|exists:days,id",
            "work_days.*.from" => "required|string",
            "work_days.*.to" => "required|string",
            'logo' =>  [
                'required',
                'mimes:png,jpg,jpeg'
            ],
            'commercial_register' =>  [
                'required_if:type,company',
                'mimes:png,jpg,jpeg,pdf'
            ],
            'commercial_signature' =>  [
                'required_if:type,company',
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
