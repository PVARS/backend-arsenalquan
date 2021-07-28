<?php


namespace App\Http\Request;


class LoginRequest extends HttpRequest
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
            'login_id' => 'required|min:3|max:254',
            'password' => 'required|min:6|max:50'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'login_id.required' => 'Vui lòng nhập tên đăng nhập.',
            'login_id.min' => 'Tên đăng nhập không được bé hơn 3 ký tự.',
            'login_id.max' => 'Tên đăng nhập không được quá 254 ký tự.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu không được bé hơn 6 ký tự.',
            'password.max' => 'Mật khẩu không được quá 50 ký tự.',
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->only(['login_id','password']);
    }
}
