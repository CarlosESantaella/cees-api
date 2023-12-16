<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientPostRequest extends FormRequest
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
            'full_name' => 'string|min:6|max:120',
            'address' => 'string|min:6|max:120',
            'nit' => 'string|min:6|max:120',
            'contact' => 'string|min:6|max:120'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'El campo nombre es obligatorio.',
            'full_name.string' => 'El campo nombre debe ser una cadena de caracteres.',
            'full_name.min' => 'El campo nombre debe tener al menos :min caracteres.',
            'full_name.max' => 'El campo nombre no debe ser mayor a :max caracteres.',
            'address.required' => 'El campo dirección es obligatorio.',
            'address.string' => 'El campo dirección debe ser una cadena de caracteres.',
            'address.min' => 'El campo dirección debe tener al menos :min caracteres.',
            'address.max' => 'El campo dirección no debe ser mayor a :max caracteres.',
            'nit.required' => 'El campo nit es obligatorio.',
            'nit.string' => 'El campo nit debe ser una cadena de caracteres.',
            'nit.min' => 'El campo nit debe tener al menos :min caracteres.',
            'nit.max' => 'El campo nit no debe ser mayor a :max caracteres.',
            'contact.required' => 'El campo contacto es obligatorio.',
            'contact.string' => 'El campo contacto debe ser una cadena de caracteres.',
            'contact.min' => 'El campo contacto debe tener al menos :min caracteres.',
            'contact.max' => 'El campo contacto no debe ser mayor a :max caracteres.',
        ];
    }
}
