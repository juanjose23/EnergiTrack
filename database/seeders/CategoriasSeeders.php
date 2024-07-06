<?php

namespace Database\Seeders;

use App\Models\Categorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categorias = [
            [
                'nombre' => 'Plan Avanzado',
                'descripcion' => 'Este plan está dirigido a medianas y grandes empresas que requieren herramientas avanzadas para optimizar su eficiencia energética y reducir costos.',
                'estado' => 1
            ],
            [
                'nombre' => 'Plan Basico',
                'descripcion' => 'Este plan está diseñado para pequeñas empresas o usuarios individuales que necesitan una solución sencilla para gestionar y monitorear su consumo energético.',
                'estado' => 1
            ],
           
        ];


        foreach ($categorias as $categoria) {
            Categorias::create($categoria);
          
        }
    }
}
