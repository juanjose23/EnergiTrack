<?php

namespace Database\Seeders;

use App\Models\Personas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class PersonasSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $personas = [
            [
                'nombre' => 'Emorie del Carmen',
                'apellido' => 'Aguirre Lacayo',
                'tipo_identificacion' =>'Cedula',
                'identificacion' => '001-250203-1234W',
               'telefono' => '78451263',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($personas as $persona) {
            $person = Personas::create($persona);
            $person->save();
        }
    }
}
