<?php

namespace App\Http\Requests;

class AddCartRequest extends BaseRequest
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
            'attributes' => 'required|array',
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'variant_id' => 'required|numeric',
            'variant_price' => 'required'
        ];
    }
}
