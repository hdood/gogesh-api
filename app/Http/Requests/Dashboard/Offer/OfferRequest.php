<?php

namespace App\Http\Requests\Dashboard\Offer;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'condition' => 'required',
            'image' => 'nullable',
            // 'sector_id' => 'required|exists:sectors,id',
            // 'activity_id' => 'required|exists:activities,id',
            // 'speciality_id' => 'required|exists:specialities,id',
            'season_id' => 'required|integer',
            'duration_id' => 'nullable|integer',
            'seller_id' => 'required|exists:sellers,id',
            'offer_id' => 'nullable|integer',
            // 'bold' => 'required|integer',
            'price' => 'required|numeric',
            'discount_rate' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'status' => 'required|string',
            'reason_id' => 'nullable|integer|min:0|max:1000',
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
