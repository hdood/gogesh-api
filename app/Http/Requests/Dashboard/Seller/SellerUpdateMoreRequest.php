<?php

namespace App\Http\Requests\Dashboard\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SellerUpdateMoreRequest extends FormRequest
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
            'specialities_id' => 'required',
            'seasons_id' => 'required',
            'email' => 'required|email|unique:sellers,email,' . $userId,
            'delivery' => 'required|boolean',
            'delivery_price' => 'required|numeric',
        ];
    }
}
