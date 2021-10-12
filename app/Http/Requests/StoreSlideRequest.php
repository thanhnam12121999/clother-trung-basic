<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlideRequest extends FormRequest
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
            'title' => 'required',
            'image' => 'required|image',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tên danh mục không được trống',
            'content.required' => 'Nội dung không được trống',
            'image.required' => 'Ảnh danh mục không được trống',
            'image.image' => 'Ảnh danh mục không đúng định dạng'
        ];
    }
}
