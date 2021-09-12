<?php


namespace App\Http\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class HttpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     */
    public function __construct(){
    }

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = [
            'message' => 'Dữ liệu không hợp lệ.',
            'errors' => $validator->messages()->toArray()
        ];
        throw new HttpResponseException(response()->json($errors, 422));
    }

}
