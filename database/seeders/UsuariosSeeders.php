<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
class UsuariosSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $usuarios = [
            [
                'personas_id' =>1,
                'email' => 'emorie@energitrack.com',
                'password' => Hash::make('12345678'),
                'provider' => null,
                'provider_id' => null,
                'email_verified_at' => Carbon::now(),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($usuarios as $usuario) {
            $user = User::create($usuario);

            // Marcar el usuario como verificado
            $user->email_verified_at = now();
            $user->save();
        }
    }
}
