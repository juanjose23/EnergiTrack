<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlan extends FormRequest
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
        $planId = $this->route('plan');
        return [
            'nombre' => [
                'required',
                Rule::unique('planes', 'nombre')->ignore($planId),
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'categorias' => 'required|exists:categorias,id',
            'dispositivos' => 'required|integer|min:1',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'estado' => 'required|boolean',
            'descripcion' => 'nullable|string|max:1000',
        ];
    }
}
