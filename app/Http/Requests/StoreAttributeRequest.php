<?php

namespace App\Http\Requests;

class StoreAttributeRequest extends BaseRequest
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
            'attr_name' => 'required',
            'attribute_values' => 'required|array|min:1',
            'attribute_values.*' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'attr_name.required' => 'Tên thuộc tính không được trống',
            'attribute_values.*.required' => 'Giá trị thuộc tính không được trống'
        ];
    }
}
