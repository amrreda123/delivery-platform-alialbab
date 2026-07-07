<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
            'phone' => 'required|string|max:20|exists:users,phone',
            'vehicle_type' => 'required|in:motorcycle,car,bicycle,van',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.exists' => 'لا يوجد مستخدم بهذا الرقم في النظام.',
        ];
    }
}
