<?php

namespace App\Http\Requests\Api\Company;

use App\Models\Seller;
use App\Rules\ScheduleRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class UpdateCommercialActivityRequest extends FormRequest
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
            'sector_id' => 'required|exists:sectors,id',
            'activity_id' => 'required|exists:activities,id',
            'type' => 'required|in:Company,Personal',
            'name' => 'required|min:5',
            'phone' => 'required|regex:/[0-9]{9}/',
            'description' => 'required|min:20',
            "commercial_number" => 'required',
            'delivery' => 'required|boolean',
            'delivery_value' => 'required_if:delivery,true|numeric',
            "address" => "required|string",

            "logo_path" => "required_if:logo,null|string",
            'logo' => ['required_if:logo_path,null', File::types(['png', 'jpg', 'jpeg'])],

            "commercial_register_path" => "required_if:commercial_register,null|string",
            'commercial_register' => ['required_if:commercial_register_path,null', File::types(['png', 'jpg', 'jpeg','webp'])],

            "commercial_signature_path" => "required_if:commercial_signature,null|string",
            'commercial_signature' => ['required_if:commercial_signature_path,null', File::types(['png', 'jpg', 'jpeg','webp'])],

            'reason' => "required|string"
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
