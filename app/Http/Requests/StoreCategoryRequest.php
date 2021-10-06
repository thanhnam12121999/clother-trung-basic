<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories',
            'image' => 'required|image',
            'description' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được trống',
            'name.unique' => 'Danh mục đã tồn tại',
            'image.required' => 'Ảnh danh mục không được trống',
            'image.image' => 'Ảnh danh mục không đúng định dạng'
        ];
    }
}
