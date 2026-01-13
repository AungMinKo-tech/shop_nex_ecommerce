<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'price' => 'required|numeric|min:0',
            'photo' => 'required|string',
            'description' => 'required|string',
            'detail' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->errorResponse($validator->errors()->first(), 422)
        );
    }
}
