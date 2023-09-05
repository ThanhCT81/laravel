<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255|unique:product_categories,name,' . $this->id,
            'status' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng điền tên!!!',
            'name.min' => 'Tên phải trên 3 kí tự!!!',
            'name.max' => 'Tên phải dưới 255 kí tự!!!',
            'status.required' => 'Vui lòng chọn trạng thái!!!'
        ];
    }
}
