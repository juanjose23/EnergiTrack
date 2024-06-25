<?php

namespace Database\Seeders;

use App\Models\submodulos as ModelsSubmodulos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class submodulos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $submodulos = [
            [
                'modulos_id'=>1,
                'nombre' => 'Categorías',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
            [
                'modulos_id'=>1,
                'nombre' => 'Planes',
                'descripcion' => '',
                'enlace'=> '',
                'estado' => 1
            ],
            [
                'modulos_id'=>1,
                'nombre' => 'Precios',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
            [
                'modulos_id'=>2,
                'nombre' => 'Ventas',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
            [
                'modulos_id'=>2,
                'nombre' => 'Clientes',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
            [
                'modulos_id'=>3,
                'nombre' => 'Auditoria',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
            [
                'modulos_id'=>4,
                'nombre' => 'Casos',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
            [
                'modulos_id'=>4,
                'nombre' => 'Planes',
                'descripcion' => '',
                'enlace'=>null,
                'estado' => 1
            ],
            [
                'modulos_id'=>5,
                'nombre' => 'Roles',
                'descripcion' => '',
                'enlace'=>'roles.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>5,
                'nombre' => 'Usuarios',
                'descripcion' => '',
                'enlace'=>'usuarios.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>5,
                'nombre' => 'Privilegios',
                'descripcion' => '',
                'enlace'=>'privilegios.index',
                'estado' => 1
            ],
            [
                'modulos_id'=>5,
                'nombre' => 'Permisos',
                'descripcion' => '',
                'enlace'=>'permisos.index',
                'estado' => 1
            ],
            
        ];

        // Crear los modelos utilizando el array
        foreach ($submodulos as $submodulo) {
            ModelsSubmodulos::create($submodulo);
        }
    }
}
