<?php

namespace App\Http\Requests;

use App\Models\Seller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StripCheckoutRequest extends FormRequest
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
            'amount' => "required|numeric",
            'type' => "required|in:Subscription,Verification,Fees,Active_Cmmercial_Activity,Ads_Paid,Offer_Paid",
            'package_id' => "required_if:type,Subscription|exists:packages,id",
            'ads_id' => "required_if:type,Ads_Paid|exists:ads,id",
            'offer_id' => "required_if:type,Offer_Paid|exists:offers,id",
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
