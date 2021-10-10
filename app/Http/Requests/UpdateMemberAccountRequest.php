<?php

namespace App\Http\Requests;

use App\Repositories\AccountRepository;
use App\Rules\CheckUniqueMemberEmail;
use App\Rules\CheckUniqueMemberPhoneNumber;
use App\Rules\CheckUniqueMemberUsername;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberAccountRequest  extends FormRequest
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
    public function rules(AccountRepository $accountRepository)
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                new CheckUniqueMemberEmail($accountRepository)
            ],
            'username' => [
                'required',
                new CheckUniqueMemberUsername($accountRepository)
            ],
            'phone_number' => [
                'required',
                'numeric',
                new CheckUniqueMemberPhoneNumber($accountRepository)
            ],
            'gender' => 'boolean',
            'date_of_birth' => 'nullable|date_format:Y-m-d|before:today',
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
            // 'email.unique' => 'Email đã được sử dụng',
            'email.email' => 'Sai định dạng mail',
            'username.required' => 'Bạn phải nhập tên đăng nhập',
            // 'username.unique' => 'Tên đăng nhập đã được sử dụng',
            'phone_number.numeric' => 'Chỉ nhập số',
            'gender.boolean' => 'Chỉ được chọn giá trị nam hoặc nữ',
            'date_of_birth.date_format' => 'Sai định dạng',
            'date_of_birth.before' => 'Cần nhập đúng ngày sinh',
            'avatar.image' => 'Sai định dạng ảnh.',
            'phone_number.max' => 'Số điện thoại tối thiểu 10 số',
            'phone_number.required' => 'Hãy nhập số điện thoại.'
        ];
    }
}
