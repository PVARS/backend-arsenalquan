<?php


namespace App\Http\Request\Category;


use App\Http\Request\HttpRequest;

class CategoryRequest extends HttpRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'category_name' => 'required|max:254|unique:category,category_name,'.$this->category,
            'slug' => 'unique:category,slug,'.$this->category
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'category_name.required' => 'Vui lòng nhập tên danh mục.',
            'category_name.max' => 'Tên danh mục không được quá 254 ký tự.',
            'category_name.unique' => 'Danh mục này đã tồn tại.',
            'slug.unique' => 'URL đã tồn tại.'
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->only(['category_name', 'icon']);
    }
}
