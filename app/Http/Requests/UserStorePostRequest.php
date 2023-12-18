<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStorePostRequest extends FormRequest
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
            'name' => 'required|string|min:6|max:255',
            'email' => 'required|email|min:8|max:255',
            'password' => 'required|string|min:6|max:255',
            'profile' => 'integer|max:255'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de caracteres.',
            'name.min' => 'El campo nombre debe tener al menos :min caracteres.',
            'name.max' => 'El campo nombre no debe ser mayor a :max caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.min' => 'El campo email debe tener al menos :min caracteres.',
            'email.max' => 'El campo email no debe ser mayor a :max caracteres.',
            'password.required' => 'El campo password es obligatorio.',
            'password.string' => 'El campo password debe ser una cadena de caracteres.',
            'password.min' => 'El campo password debe tener al menos :min caracteres.',
            'password.max' => 'El campo password no debe ser mayor a :max caracteres.',
            'profile.integer' => 'El campo profile debe ser un número entero.',
            'profile.max' => 'El campo profile no debe ser mayor a :max caracteres.',
        ];
    }
}
