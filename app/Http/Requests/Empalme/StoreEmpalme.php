<?php

namespace App\Http\Requests;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class StoreEmpalme extends FormRequest
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
            'id' => 'required|numeric|min:0|unique:empalme|unique:distribucion',
            'cp' => 'required|numeric|min:0|exists:municipio',
            'calle_id' => 'required|numeric|min:0|exists:callejero,id',
            'numero' => 'required|numeric|min:0|max:65535',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'in' => 'required|numeric|min:0|max:65535',
            'out' => 'required|numeric|min:0|max:65535',
            'con' => 'required|numeric|min:0|max:65535'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, new JsonResponse($validator->errors(), 400)));
    }
}
