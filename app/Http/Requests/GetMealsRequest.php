<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class GetMealsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lang' => ['bail', 'required', Rule::in(Language::pluck('locale')->toArray())],
            'per_page' => 'sometimes|integer',
            'page' => 'sometimes|integer',
            'diff_time' => 'sometimes|integer',
            'category' => ['sometimes', 'regex:/^(?:\d{1,9}|NULL|!NULL)$/'],
            'with' => ['sometimes', 'regex:/(ingredients|category|tags)(,\s*(ingredients|category|tags))*$/'],
            'tags' => ['sometimes', 'regex:/^\d+(?:,\d+)*$/']
        ];
    }

    public function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'lang.in' => 'The selected lang is invalid. Available languages: ' .
                implode(',', Language::pluck('locale')->toArray()) . '.'
        ];
    }
}
