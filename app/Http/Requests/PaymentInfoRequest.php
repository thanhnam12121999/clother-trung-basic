<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentInfoRequest extends FormRequest
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
            'address' => 'required',
            'phone_number' => 'required|numeric|min:10',
            'email' => 'required|email',
            'note' => 'nullable',
            'payment_method' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Hãy nhập họ tên',
            'address.required' => 'Hãy nhập địa chỉ',
            'phone_number.required' => 'Hãy nhập số điện thoại',
            'phone_number.numeric' => 'Chỉ nhập số',
            'phone_number.min' => 'Số điện thoại tối thiểu 10 số',
            'email.required' => 'Hãy nhập địa chỉ email',
            'email.email' => 'Sai định dạng email',
            'payment_method.required' => 'Hãy chọn phương thức thanh toán'
        ];
    }
}
