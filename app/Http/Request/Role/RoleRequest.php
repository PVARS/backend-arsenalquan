<?php


namespace App\Http\Request\Role;


use App\Http\Request\HttpRequest;

class RoleRequest extends HttpRequest
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
            'role_name' => 'required|max:254|unique:role,role_name,'.$this->role
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'role_name.required' => 'Vui lòng nhập tên vai trò.',
            'role_name.max' => 'Tên vai trò không được quá 254 ký tự.',
            'role_name.unique' => 'Vai trò này đã tồn tại'
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
