<?php

namespace App\Http\Requests\Empalme;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdateEmpalme extends FormRequest
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
            'id' => 'numeric|min:0|unique:empalme|unique:distribucion',
            'cp' => 'numeric|min:0',
            'lat' => 'numeric',
            'lon' => 'numeric',
            'in' => 'numeric|min:0|max:65535',
            'out' => 'numeric|min:0|max:65535',
            'con' => 'numeric|min:0|max:65535'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, new JsonResponse($validator->errors(), 400)));
    }
}
