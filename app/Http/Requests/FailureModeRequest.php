<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FailureModeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'failure_mode' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'failure_mode.required' => 'El campo modo de falla es obligatorio.',
            'failure_mode.string' => 'El campo modo de falla debe ser una cadena de caracteres.',
            'failure_mode.max' => 'El campo modo de falla no debe ser mayor a 120 caracteres.',
        ];
    }

}
