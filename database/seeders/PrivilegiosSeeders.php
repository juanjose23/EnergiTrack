<?php

namespace Database\Seeders;

use App\Models\Privilegios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivilegiosSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $privilegios = [
            ['roles_id' => 3, 'submodulos_id' => 6, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55'],
            ['roles_id' => 3, 'submodulos_id' => 4, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55'],
            ['roles_id' => 3, 'submodulos_id' => 5, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55'],
            ['roles_id' => 3, 'submodulos_id' => 7, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55'],
            ['roles_id' => 3, 'submodulos_id' => 8, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55'],
            ['roles_id' => 3, 'submodulos_id' => 1, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55'],
            ['roles_id' => 3, 'submodulos_id' => 2, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55'],
            ['roles_id' => 3, 'submodulos_id' => 3, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55'],
            ['roles_id' => 3, 'submodulos_id' => 9, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55'],
            ['roles_id' => 3, 'submodulos_id' => 10, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55'],
            ['roles_id' => 3, 'submodulos_id' => 11, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55'],
            ['roles_id' => 3, 'submodulos_id' => 12, 'estado' => 1, 'created_at' => '2024-06-24 23:36:55', 'updated_at' => '2024-06-24 23:36:55']
        ];
        
        foreach ($privilegios as $privilegio) {
            Privilegios::Create($privilegio);
        }
    }
}
