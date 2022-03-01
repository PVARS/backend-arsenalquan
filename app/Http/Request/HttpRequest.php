<?php


namespace App\Http\Request;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class HttpRequest extends FormRequest
{
    /**
     * Custom response validation
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'STATUS' => 'NG',
            'ERRORS' => $validator->errors()->all()
        ], 200));
    }
}
