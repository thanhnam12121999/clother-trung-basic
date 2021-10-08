<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'summary' => 'required',
            'feature_image' => 'nullable|image',
            'image_list' => 'nullable|array',
            'image_list.*' => 'image',
            'attribute_product' => 'required|array|min:1',
            'attribute_product.*' => 'numeric|exists:attribute_values,id',
            'status' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được trống',
            'category_id.required' => 'Danh mục bắt buộc phải chọn',
            'summary.required' => 'Tóm lược sản phẩm không được trống',
            'feature_image.image' => 'Ảnh đại diện sai định dạng',
            'image_list.*.image' => 'Ảnh đại diện sai định dạng',
            'attribute_product.required' => 'Thuộc tính sản phẩm là bắt buộc',
        ];
    }
}
