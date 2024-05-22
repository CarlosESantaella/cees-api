<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PhotoItemsDiagnosesRequest extends FormRequest
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
            'description' => 'required|string',
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    public function messages(): array
    {
        return [
            'description.required' => 'El campo descripción es obligatorio.',
            'description.string' => 'El campo descripción debe ser una cadena de caracteres.',
            'photo.required' => 'El campo foto es obligatorio.',
            'photo.file' => 'El campo foto debe ser un archivo.',
            'photo.mimes' => 'El campo foto debe ser un archivo de tipo: jpeg, png, jpg, gif, svg.',
            'photo.max' => 'El campo foto no debe ser mayor a :max kilobytes.',
        ];
    }
}
