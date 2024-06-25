<?php

namespace Database\Seeders;

use App\Models\permisosroles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisosRolesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permisosRoles = [
            ['roles_id' => 3, 'permisosmodulos_id' => 1, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 2, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 3, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 12, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 13, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 14, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 4, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 5, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 6, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 7, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 8, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 9, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 10, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 11, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 15, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 16, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 17, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23'],
            ['roles_id' => 3, 'permisosmodulos_id' => 18, 'estado' => 1, 'created_at' => '2024-06-24 23:34:23', 'updated_at' => '2024-06-24 23:34:23']
        ];
        

        // Crear los modelos utilizando el array
        foreach ($permisosRoles as $permiso) {
            permisosroles::create($permiso);
        }
    }
}
