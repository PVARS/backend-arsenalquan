<?php


namespace App\Http\Request\News;


use App\Http\Request\HttpRequest;

class NewsRequest extends HttpRequest
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
            'category_id' => 'required|numeric',
            'title' => 'required|max:254',
            'short_description' => 'max:254',
            'slug' => 'unique:news,slug,'.$this->news
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.numeric' => 'Giá trị danh mục không chính xác.',

            'title.required' => 'Vui lòng nhập tiêu đề.',
            'title.max' => 'Tiêu đề không được quá 254 ký tự.',

            'short_description.max' => 'Mô tả không được quá 254 ký tự.',

            'slug.unique' => 'URL đã tồn tại.'
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->only(['category_id','title', 'short_description', 'thumbnail', 'content', 'key_word', 'slug']);
    }
}
