<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SigninRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
            'remember_me' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Email là bắt buộc',
            'password.required' => 'Mật khẩu là bắt buộc'
        ];
    }
}
