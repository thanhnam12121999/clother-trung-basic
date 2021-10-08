<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManagerAccountRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:accounts,email,'.$this->id,
            'username' => 'required|unique:accounts,username,'.$this->id,
            'number_phone' => 'required|numeric',
            'gender' => 'required|boolean',
            'date_of_birth' => 'date_format:Y-m-d|before:today|nullable',
            'avatar' => 'image',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Bạn phải nhập họ tên.',
            'email.required' => 'Bạn phải nhập địa chỉ email.',
            'email.unique' => 'Email đã được sử dụng',
            'email.email' => 'Sai định dạng mail',
            'username.required' => 'Bạn phải nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập đã được sử dụng',
            'number_phone.required' => 'Bạn cần nhập số điện thoại',
            'number_phone.numeric' => 'Chỉ nhập số',
            'gender.required' => 'Bạn cần chọn giới tính',
            'gender.boolean' => 'Chỉ được giá trị chọn nam hoặc nữ',
            'date_of_birth.date_format' => 'Sai định dạng',
            'date_of_birth.before' => 'Cần nhập đúng ngày sinh',
            'avatar.image' => 'Sai định dạng ảnh .'
        ];
    }
}
