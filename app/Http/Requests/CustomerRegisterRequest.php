<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Everyone can attempt to register
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:8', 'max:50'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'phone' => [
                'required', 
                'string', 
                'regex:/^01[0125][0-9]{8}$/', 
                function ($attribute, $value, $fail) {
                    $user = User::where('phone', $value)->first();
                    if ($user) {
                        if ($user->role !== 'customer') {
                            $fail('هذا الرقم غير صالح للتسجيل.');
                        } 
                        elseif ($user->email !== null) {
                            $fail('رقم الموبايل مسجل مسبقاً ولديه حساب بالفعل، برجاء تسجيل الدخول.');
                        }
                    }
                }
            ],
            'last_order_code' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($this->phone) {
                        $user = User::where('phone', $this->phone)->where('role', 'customer')->whereNull('email')->first();
                        if ($user) {
                            if (!$value) {
                                $fail('رقم الموبايل مرتبط بطلبات سابقة. برجاء إدخال (كود آخر طلب) لتأكيد هويتك واسترجاع طلباتك، أو استخدم رقماً جديداً.');
                                return;
                            }
                            
                            $orderExists = Order::where('user_id', $user->id)->where('tracking_code', $value)->exists();
                            if (!$orderExists) {
                                $fail('كود الطلب غير صحيح ولا يتطابق مع أي طلب مسجل بهذا الرقم.');
                            }
                        }
                    }
                }
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'الاسم بالكامل مطلوب.',
            'name.min' => 'الاسم يجب ألا يقل عن 3 أحرف.',
            'name.max' => 'الاسم يجب ألا يزيد عن 50 حرف.',
            
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب إدخال بريد إلكتروني صالح.',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً، برجاء تسجيل الدخول.',
            
            'phone.required' => 'رقم الموبايل مطلوب.',
            'phone.regex' => 'رقم الموبايل غير صحيح. يجب أن يكون رقم مصري مكون من 11 رقم.',
            'phone.unique' => 'رقم الموبايل مسجل مسبقاً، برجاء تسجيل الدخول.',
            
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'كلمة المرور يجب ألا تقل عن 8 أحرف.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ];
    }
}
