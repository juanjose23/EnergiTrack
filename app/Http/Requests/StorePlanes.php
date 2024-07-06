<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanes extends FormRequest
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
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255|unique:planes,nombre',
            'categorias' => 'required|exists:categorias,id',
            'condiciones' => 'required|array',
            'condiciones.*' => 'exists:condiciones,id',
            'dispositivos' => 'required|integer|min:1',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'estado' => 'required|boolean',
            'descripcion' => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'El nombre de la categoría ya existe.',
            'categorias.required' => 'Debe seleccionar al menos una categoría.',
            'categorias.exists' => 'La categoría seleccionada no es válida.',
            'condiciones.required' => 'Debe seleccionar al menos una condición.',
            'condiciones.*.exists' => 'Una de las condiciones seleccionadas no es válida.',
            'dispositivos.required' => 'El límite de dispositivos es obligatorio.',
            'dispositivos.integer' => 'El límite de dispositivos debe ser un número entero.',
            'dispositivos.min' => 'El límite de dispositivos debe ser al menos 1.',
            'imagen.required' => 'La imagen es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.max' => 'La imagen no puede ser mayor de 2MB.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.boolean' => 'El estado debe ser activo o inactivo.',
            'descripcion.max' => 'La descripción no puede tener más de 1000 caracteres.',
        ];
    }
}
