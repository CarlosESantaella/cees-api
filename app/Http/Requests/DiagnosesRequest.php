<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DiagnosesRequest extends FormRequest
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
            'status' => 'required|boolean',
            'description' => 'required|string',
            'observations' => 'nullable|string',
            'reception_id' => 'required|integer|exists:receptions,id'
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'El campo estado es obligatorio.',
            'status.boolean' => 'El campo estado debe ser un valor booleano.',
            'description.required' => 'El campo descripción es obligatorio.',
            'description.string' => 'El campo descripción debe ser una cadena de caracteres.',
            'reception_id.required' => 'El campo recepción es obligatorio.',
            'reception_id.integer' => 'El campo recepción debe ser un número entero.',
            'reception_id.exists' => 'El campo recepción no existe en la base de datos.',
            'observations.string' => 'El campo observaciones debe ser una cadena de caracteres.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
