<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsers extends FormRequest
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
            'nombre'=>'required |regex:/^[a-zA-Z\s]+$/',
            'apellido'=>'required |regex:/^[a-zA-Z\s]+$/',
            'telefono' => 'required|unique:personas,telefono',
            'tipo' => 'required',
            'identificacion' => ['regex:/^\d{3}-\d{6}-\d{4}[a-zA-Z]$/','required','unique:personas,identificacion'],
            'roles' => 'required|exists:roles,id',
            'estado' => 'required|in:2,0', 
            'foto' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre' => 'El nombre es requerido',
            'roles.required' => 'Por favor selecciona un rol.',
            'roles.exists' => 'El rol seleccionado no es válido.',
            'estado.required' => 'Por favor selecciona un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}
