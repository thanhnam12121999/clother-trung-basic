<?php

namespace App\Http\Requests;

class UpdateVariantRequest extends BaseRequest
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
            'amount' => 'required|array',
            'amount.*' => 'required|numeric',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'amount.*.required' => 'Số lượng biến thể không được trống',
            'unit_price.*.required' => 'Giá biến thể không được trống'
        ];
    }
}
