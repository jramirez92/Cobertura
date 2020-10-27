<?php

namespace App\Http\Requests\Callejero;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class DecodeAdress extends FormRequest
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
            'cp' => 'required|min:0|exists:municipio,cp',
            'calle' => 'required',
            'numero' => 'required|numeric|min:0|max:65535'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, new JsonResponse($validator->errors(), 400)));
    }
}
