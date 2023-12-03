<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombre' => 'Administrador',
            'email' => 'admin@ferretec.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'es_admin' => 1,
            'es_marketing' => 0,
            'es_cajero' => 0,
            'es_cliente' => 0,
            'es_vip' => 0,
        ]);

        User::create([
            'nombre' => 'Cliente1',
            'email' => 'cliente@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'es_admin' => 0,
            'es_marketing' => 0,
            'es_cajero' => 0,
            'es_cliente' => 1,
            'es_vip' => 0,
        ]);

        Usuario::create([
            'nombre' => 'Administrador',
            'email' => 'admin@ferretec.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'es_admin' => 1
        ]);
    }
}