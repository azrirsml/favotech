<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'car_type_id' => 'required',
            'rent_price' => 'required',
            'promo_price' => 'nullable',
            'status' => 'required',
            'available_date' => ['required', 'after_or_equal:today'],
            'description' => ['required', 'string'],
            'rules' => ['required', 'string'],
            'images' => ['required', 'exclude'],
        ];
    }
}
