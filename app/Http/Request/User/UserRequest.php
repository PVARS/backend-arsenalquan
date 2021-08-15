<?php


namespace App\Http\Request\User;


use App\Http\Request\HttpRequest;

class UserRequest extends HttpRequest
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
            'login_id' => 'required|max:254|unique:user,login_id,'.$this->user,
            'password' => 'required|min:6|max:50',
            'role_id' => 'required|integer|max:10',
            'email' => 'required|max:254|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:user,email,'.$this->user,
            'full_name' => 'required|min:6|max:254'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'login_id.required' => 'Vui lòng nhập tên đăng nhập.',
            'login_id.max' => 'Tên đăng nhập không được quá 254 ký tự.',
            'login_id.unique' => 'Tên đăng nhập đã được sử dụng',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu không được bé hơn 6 ký tự.',
            'password.max' => 'Mật khẩu không được quá 50 ký tự.',

            'role_id.required' => 'Vui lòng chọn vai trò.',
            'role_id.integer' => 'Chỉ được nhập ký tự số.',
            'role_id.max' => 'Vai trò không được quá 10 ký tự.',

            'email.required' => 'Vui lòng nhập email.',
            'email.max' => 'Mật khẩu không được quá 254 ký tự.',
            'email.regex' => 'Email không đúng định dạng ***@domain.com.',
            'email.unique' => 'Email đã được sử dụng',

            'full_name.required' => 'Vui lòng nhập họ tên.',
            'full_name.min' => 'Họ tên không được bé hơn 6 ký tự.',
            'full_name.max' => 'Họ tên không được quá 254 ký tự.',
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->only(['login_id','password', 'role_id', 'email', 'full_name']);
    }
}
