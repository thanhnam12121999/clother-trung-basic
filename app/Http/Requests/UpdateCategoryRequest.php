<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        // dd($this->category);
        return [
            'name' => 'required|unique:categories,name,' . $this->category->id,
            'image' => 'nullable|image',
            'description' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được trống',
            'name.unique' => 'Danh mục đã tồn tại',
            'image.image' => 'Ảnh danh mục không đúng định dạng'
        ];
    }
}
