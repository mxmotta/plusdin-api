<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CardsRequest extends FormRequest
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
            'name'          =>  ['required', 'max:80', 'unique:cards'],
            'slug'          =>  ['required', 'max:45', 'unique:cards'],
            'limit'         =>  ['|regex:/^\d+(\.\d{1,2})?$/'],
            'annual_fee'    =>  ['|regex:/^\d+(\.\d{1,2})?$/'],
            'category_id'   =>  ['integer', 'exists:category']
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json([
                'success'   => false,
                'errors'    => $errors
            ], 400)
        );
    }

}
