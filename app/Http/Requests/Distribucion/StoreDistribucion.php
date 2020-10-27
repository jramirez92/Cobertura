<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreDistribucion extends FormRequest
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
            'empalme_id' => 'required|numeric|min:0|exists:empalme,id',
            'cp' => 'required|numeric|min:0',
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

