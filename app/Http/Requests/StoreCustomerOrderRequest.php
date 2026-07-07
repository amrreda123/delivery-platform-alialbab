<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerOrderRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'store_id' => 'nullable|exists:stores,id',
            'pickup_address' => 'nullable|string',
            'notes' => 'required|string',
            'delivery_area_id' => 'nullable',
            'dropoff_address' => 'required|string',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (empty($this->store_id) && empty($this->pickup_address)) {
                $validator->errors()->add('pickup_address', 'يرجى تحديد متجر أو كتابة عنوان المتجر.');
            }
        });
    }
}
