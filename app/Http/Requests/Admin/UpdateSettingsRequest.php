<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
            'vodafone_cash_number' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/'],
            'etisalat_cash_number' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/'],
            'whatsapp_link'        => ['nullable', 'url', 'max:255'],
            'facebook_link'        => ['nullable', 'url', 'max:255'],
            'instagram_link'       => ['nullable', 'url', 'max:255'],
            'youtube_link'         => ['nullable', 'url', 'max:255'],
            'tiktok_link'          => ['nullable', 'url', 'max:255'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'vodafone_cash_number.required' => 'رقم فودافون كاش مطلوب.',
            'vodafone_cash_number.regex'    => 'رقم فودافون كاش غير صالح (يجب أن يكون رقم مصري يبدأ بـ 01).',
            
            'etisalat_cash_number.required' => 'رقم اتصالات كاش مطلوب.',
            'etisalat_cash_number.regex'    => 'رقم اتصالات كاش غير صالح (يجب أن يكون رقم مصري يبدأ بـ 01).',
            
            'whatsapp_link.url'             => 'يجب أن يكون الرابط صحيحاً.',
            'facebook_link.url'             => 'يجب أن يكون الرابط صحيحاً.',
            'instagram_link.url'            => 'يجب أن يكون الرابط صحيحاً.',
            'youtube_link.url'              => 'يجب أن يكون الرابط صحيحاً.',
            'tiktok_link.url'               => 'يجب أن يكون الرابط صحيحاً.',
            
            '*.max'                         => 'طول الرابط يجب ألا يتجاوز 255 حرفاً.',
        ];
    }
}
