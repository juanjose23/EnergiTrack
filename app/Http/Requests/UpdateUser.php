<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
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
        $usuarios = $this->route('usuarios');
        return [
            'nombre' => [
                'nullable',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'apellido' => [
                'nullable',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'telefono' => [
                'nullable',
                Rule::unique('personas')->ignore($usuarios->personas_id)
            ],
            'identificacion' => [
                'nullable',
                'regex:/^\d{3}-\d{6}-\d{4}[a-zA-Z]$/',
                Rule::unique('personas')->ignore($usuarios->personas_id)
            ],
            'roles' => [
                'nullable',
                'sometimes',
                'exists:roles,id'
            ],
            'estado' => [
                'nullable',
                'in:1,0'
            ],
        ];
    }
    

}
