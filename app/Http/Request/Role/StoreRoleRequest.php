<?php


namespace App\Http\Request\Role;


use App\Http\Request\HttpRequest;

class StoreRoleRequest extends HttpRequest
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
            'role_name' => 'required|max:254'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'role_name.required' => 'Vui lòng nhập tên vai trò.',
            'role_name.max' => 'Tên đăng nhập không được quá 254 ký tự.'
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->only(['role_name']);
    }
}
