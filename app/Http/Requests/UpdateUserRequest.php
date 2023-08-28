<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'required|same:confirm-password',
            'confirm-password' => 'required',
            'role' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'يرجا ادخال اسم المستخدم',
            'email.email' => 'يرجي ادخال الايميل',
            'email.unique' => 'يرجي عدم تكرار الايميل',
            'email.required' => 'يرجي ادخال الايميل',
            'password.required' => 'يرجي ادخال كلمه المرور',
            'password.same' => 'يرجي مطابقه كلمه المرور ',
            'confirm-password.required' => 'يرجي ادخال كلمه المرور',
            'role.required' => 'يؤجي اختيار الصلاحيات'
        ];
    }
}