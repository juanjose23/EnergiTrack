<?php

namespace Database\Seeders;

use App\Models\RolesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //
    public function run()
    {
        $roles = [
            [
                'nombre' => 'Clientes Naturales',
                'descripcion' =>null,
                'estado' => 1,
            ],
            [
                'nombre' => 'Clientes Juridicos',
                'descripcion' =>null,
                'estado' => 1,
            ],
            [
                'nombre' => 'Administrador del Sistema',
                'descripcion' => 'Tiene acceso completo a todas las funciones del sistema.',
                'estado' => 1,
            ],

            [
                'nombre' => 'Inspector',
                'descripcion' => 'Responsable de la inspección.',
                'estado' => 1,
            ],

            [
                'nombre' => 'Encargado de planes',
                'descripcion' => 'Encargado de gestionar las promociones.',
                'estado' => 1,
            ],
            [
                'nombre' => 'Encargado de Soporte',
                'descripcion' => 'Responsable de interactuar con los clientes y realizar ventas.',
                'estado' => 1,
            ],
            [
                'nombre' => 'Soporte',
                'descripcion' => '',
                'estado' => 1,
            ],
            [
                'nombre' => 'Encargado de ventas',
                'descripcion' => '',
                'estado' => 1,
            ],
          
        ];

        // Crear los modelos utilizando el array
        foreach ($roles as $rol) {
            RolesModel::create($rol);
        }
    }
}
