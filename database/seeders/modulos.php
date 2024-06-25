<?php

namespace Database\Seeders;

use App\Models\modulos as ModelsModulos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class modulos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modulos = [
            [
                'nombre' => 'Gestión de Planes',
                'descripcion' => '',
                'icono'=>'bx bx-notepad',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de ventas',
                'descripcion' => '',
                'icono'=>'bx bx-shopping-bag',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de Auditoria',
                'descripcion' => '',
                'icono'=>'bx bx-shield',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de Soporte',
                'descripcion' => '',
                'icono'=>'bx bx-support',
                'estado' => 1
            ],
            [
                'nombre' => 'Gestión de usuarios',
                'descripcion' => '',
                'icono'=>'bx bx-group',
                'estado' => 1
            ],
        ];

        // Crear los modelos utilizando el array
        foreach ($modulos as $modulo) {
            ModelsModulos::create($modulo);
        }
    }
}
