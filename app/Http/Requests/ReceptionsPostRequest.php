<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReceptionsPostRequest extends FormRequest
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
            'equipment_type' => 'string|min:3|max:120|required',
            'brand' => 'string|min:2|max:120|required',
            'model' => 'string|min:2|max:120|required',
            'serie' => 'string|min:6|max:120|required',
            'capability' => 'string|min:3|max:120|required',
            'comments' => 'string|min:3|max:120',
            'state' => 'string|min:3|max:120',
            'client_id' => 'exists:clients,id|required',
            'location' => 'string|min:3|max:120',
            'specific_location' => 'string|min:3|max:120',
            'type_of_job' => 'string|min:3|max:120|in:Garantia,Nuevo',
            'equipment_owner' => 'string|min:3|max:120',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    public function messages(): array
    {
        return [
            'equipment_type.required' => 'El campo tipo equipo es obligatorio.',
            'equipment_type.string' => 'El campo tipo equipo debe ser una cadena de caracteres.',
            'equipment_type.min' => 'El campo tipo equipo debe tener al menos :min caracteres.',
            'equipment_type.max' => 'El campo tipo equipo no debe ser mayor a :max caracteres.',
            'brand.required' => 'El campo marca es obligatorio.',
            'brand.string' => 'El campo marca debe ser una cadena de caracteres.',
            'brand.min' => 'El campo marca debe tener al menos :min caracteres.',
            'brand.max' => 'El campo marca no debe ser mayor a :max caracteres.',
            'model.required' => 'El campo modelo es obligatorio.',
            'model.string' => 'El campo modelo debe ser una cadena de caracteres.',
            'model.min' => 'El campo modelo debe tener al menos :min caracteres.',
            'model.max' => 'El campo modelo no debe ser mayor a :max caracteres.',
            'serie.required' => 'El campo serie es obligatorio.',
            'serie.string' => 'El campo serie debe ser una cadena de caracteres.',
            'serie.min' => 'El campo serie debe tener al menos :min caracteres.',
            'serie.max' => 'El campo serie no debe ser mayor a :max caracteres.',
            'capability.required' => 'El campo capacidad es obligatorio.',
            'capability.string' => 'El campo capacidad debe ser una cadena de caracteres.',
            'capability.min' => 'El campo capacidad debe tener al menos :min caracteres.',
            'capability.max' => 'El campo capacidad no debe ser mayor a :max caracteres.',
            'comments.string' => 'El campo comentario debe ser una cadena de caracteres.',
            'comments.min' => 'El campo comentario debe tener al menos :min caracteres.',
            'comments.max' => 'El campo comentario no debe ser mayor a :max caracteres.',
            'client_id.integer' => 'El campo cliente debe ser un número entero.',
            'client_id.exists' => 'El cliente no existe.',
            'location.string' => 'El campo ubicación debe ser una cadena de caracteres.',
            'location.min' => 'El campo ubicación debe tener al menos :min caracteres.',
            'location.max' => 'El campo ubicación no debe ser mayor a :max caracteres.',
            'specific_location.string' => 'El campo ubicación específica debe ser una cadena de caracteres.',
            'specific_location.min' => 'El campo ubicación específica debe tener al menos :min caracteres.',
            'specific_location.max' => 'El campo ubicación específica no debe ser mayor a :max caracteres.',
            'type_of_job.string' => 'El campo tipo de trabajo debe ser una cadena de caracteres.',
            'type_of_job.min' => 'El campo tipo de trabajo debe tener al menos :min caracteres.',
            'type_of_job.max' => 'El campo tipo de trabajo no debe ser mayor a :max caracteres.',
            'type_of_job.in' => 'El campo tipo de trabajo debe ser uno de los siguientes valores: :values.',
            'equipment_owner.string' => 'El campo propietario del equipo debe ser una cadena de caracteres.',
            'equipment_owner.min' => 'El campo propietario del equipo debe tener al menos :min caracteres.',
            'equipment_owner.max' => 'El campo propietario del equipo no debe ser mayor a :max caracteres.',
        ];
    }
}
