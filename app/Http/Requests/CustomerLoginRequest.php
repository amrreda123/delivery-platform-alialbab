<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Everyone can attempt to login
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required', 
                'string', 
                'email:rfc,dns',
                Rule::exists('users', 'email')->where(function ($query) {
                    $query->whereIn('role', ['customer', 'driver']);
                })
            ],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب إدخال بريد إلكتروني صالح.',
            'email.exists' => 'هذا الحساب غير موجود أو غير مصرح لك بالدخول من هنا.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'كلمة المرور غير صحيحة.',
        ];
    }
}
