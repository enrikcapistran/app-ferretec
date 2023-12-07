<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        Usuario::create([
            'correoElectronico' => 'admin@ferretec.com',
            'contraseña' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'apellidoPaterno' => 'Administrador',
            'apellidoMaterno' => 'Administrador',
            'nombre' => 'Administrador',
            'fechaNacimiento' => '2021-01-01',
            'idRol' => '1',
            'idStatus' => '1',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        //marketing
        Usuario::create([
            'correoElectronico' => 'marketing@ferretec.com',
            'contraseña' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'apellidoPaterno' => 'Marketing',
            'apellidoMaterno' => 'Marketing',
            'nombre' => 'Marketing',
            'fechaNacimiento' => '2021-01-01',
            'idRol' => '2',
            'idStatus' => '1',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        //Almacenista
        Usuario::create([
            'correoElectronico' => 'almacenista@ferretec.com',
            'contraseña' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'apellidoPaterno' => 'Almacenista',
            'apellidoMaterno' => 'Almacenista',
            'nombre' => 'Almacenista',
            'fechaNacimiento' => '2021-01-01',
            'idRol' => '3',
            'idStatus' => '1',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        //Cajero
        Usuario::create([
            'correoElectronico' => 'cajero@ferretec.com',
            'contraseña' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'apellidoPaterno' => 'Cajero',
            'apellidoMaterno' => 'Cajero',
            'nombre' => 'Cajero',
            'fechaNacimiento' => '2021-01-01',
            'idRol' => '4',
            'idStatus' => '1',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        //Cliente
        Usuario::create([
            'correoElectronico' => 'cliente@ferretec.com',
            'contraseña' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'apellidoPaterno' => 'Cliente',
            'apellidoMaterno' => 'Cliente',
            'nombre' => 'Cliente',
            'fechaNacimiento' => '2021-01-01',
            'idRol' => '5',
            'idStatus' => '1',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        //Cliente VIP
        Usuario::create([
            'correoElectronico' => 'vip@ferretec.com',
            'contraseña' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'apellidoPaterno' => 'Cliente',
            'apellidoMaterno' => 'Cliente',
            'nombre' => 'Cliente',
            'fechaNacimiento' => '2021-01-01',
            'idRol' => '6',
            'idStatus' => '1',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
