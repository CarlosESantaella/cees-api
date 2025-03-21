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
            'equipment_type' => 'string|max:120|nullable',
            'brand' => 'string|max:120|nullable',
            'model' => 'string|max:120|nullable',
            'serie' => 'string|max:120|nullable',
            'capability' => 'string|max:120|nullable',
            'comments' => 'string|max:120|nullable',
            'state' => 'string|max:120',
            'client_id' => 'exists:clients,id|required',
            'location' => 'string|max:120|nullable',
            'specific_location' => 'string|max:120|nullable',
            'type_of_job' => 'string|max:120|in:Garantia,Nuevo|nullable',
            'equipment_owner' => 'string|max:120|nullable',
            'customer_inventory' => 'string|nullable',
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
            'equipment_type.max' => 'El campo tipo equipo no debe ser mayor a :max caracteres.',
            'brand.required' => 'El campo marca es obligatorio.',
            'brand.string' => 'El campo marca debe ser una cadena de caracteres.',
            'brand.max' => 'El campo marca no debe ser mayor a :max caracteres.',
            'model.required' => 'El campo modelo es obligatorio.',
            'model.string' => 'El campo modelo debe ser una cadena de caracteres.',
            'model.max' => 'El campo modelo no debe ser mayor a :max caracteres.',
            'serie.required' => 'El campo serie es obligatorio.',
            'serie.string' => 'El campo serie debe ser una cadena de caracteres.',
            'serie.max' => 'El campo serie no debe ser mayor a :max caracteres.',
            'capability.required' => 'El campo capacidad es obligatorio.',
            'capability.string' => 'El campo capacidad debe ser una cadena de caracteres.',
            'capability.max' => 'El campo capacidad no debe ser mayor a :max caracteres.',
            'comments.string' => 'El campo comentario debe ser una cadena de caracteres.',
            'comments.max' => 'El campo comentario no debe ser mayor a :max caracteres.',
            'client_id.integer' => 'El campo cliente debe ser un número entero.',
            'client_id.exists' => 'El cliente no existe.',
            'location.string' => 'El campo ubicación debe ser una cadena de caracteres.',
            'location.max' => 'El campo ubicación no debe ser mayor a :max caracteres.',
            'specific_location.string' => 'El campo ubicación específica debe ser una cadena de caracteres.',
            'specific_location.max' => 'El campo ubicación específica no debe ser mayor a :max caracteres.',
            'type_of_job.string' => 'El campo tipo de trabajo debe ser una cadena de caracteres.',
            'type_of_job.max' => 'El campo tipo de trabajo no debe ser mayor a :max caracteres.',
            'type_of_job.in' => 'El campo tipo de trabajo debe ser uno de los siguientes valores: :values.',
            'equipment_owner.string' => 'El campo propietario del equipo debe ser una cadena de caracteres.',
            'equipment_owner.max' => 'El campo propietario del equipo no debe ser mayor a :max caracteres.',
            'customer_inventory.string' => 'El campo inventario del cliente debe ser una cadena de caracteres.',
        ];
    }
}
