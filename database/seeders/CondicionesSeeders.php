<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CondicionesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $condiciones = [
            'Monitoreo básico del consumo eléctrico',
            'Monitoreo detallado del consumo y generación de energía',
            'Monitoreo completo con alertas y recomendaciones inteligentes',
            'Acceso a datos históricos',
            'Análisis en tiempo real',
            'Integración con dispositivos inteligentes',
            'Soporte para 5 dispositivos',
            'Soporte para 10 dispositivos',
            'Soporte para 20 dispositivos',
            'Alertas básicas de consumo excesivo',
            'Alertas personalizadas y recomendaciones avanzadas',
            'Análisis predictivo y optimización de consumo',
        ];

        foreach ($condiciones as $condicion) {
            DB::table('condiciones')->insert([
                'descripcion' => $condicion,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
