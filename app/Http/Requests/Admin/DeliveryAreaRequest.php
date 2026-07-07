<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryAreaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $areaId = $this->route('delivery_area') ? $this->route('delivery_area')->id : null;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('delivery_areas', 'name')->ignore($areaId),
            ],
            'delivery_fee' => 'required|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم المنطقة مطلوب.',
            'name.string' => 'اسم المنطقة يجب أن يكون نصاً.',
            'name.max' => 'اسم المنطقة يجب ألا يتجاوز 255 حرفاً.',
            'name.unique' => 'اسم المنطقة موجود مسبقاً.',
        ];
    }
}
