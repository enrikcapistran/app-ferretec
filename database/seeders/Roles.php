<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'idRol' => '1',
            'tipoDeusuario' => 'Administrador',
        ]);

        Role::create([
            'idRol' => '2',
            'tipoDeusuario' => 'Marketing',
        ]);
        Role::create([
            'idRol' => '3',
            'tipoDeusuario' => 'Almacenista',
        ]);
        Role::create([
            'idRol' => '4',
            'tipoDeusuario' => 'Cajero',
        ]);

        Role::create([
            'idRol' => '5',
            'tipoDeusuario' => 'Cliente',
        ]);

        Role::create([
            'idRol' => '6',
            'tipoDeusuario' => 'Cliente VIP',
        ]);
    }
}
