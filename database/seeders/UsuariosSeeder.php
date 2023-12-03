<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Role;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        // Crear un usuario administrador
        $admin = Usuario::create([
            'nombre' => 'Administrador',
            'email' => 'admin@ferretec.com',
            'password' => bcrypt('password'),
        ]);
        $this->assignRole($admin, 'admin');

        // Crear un usuario cajero
        $cajero = Usuario::create([
            'nombre' => 'Cajero1',
            'email' => 'cajero1@ferretec.com',
            'password' => bcrypt('password'),
        ]);
        $this->assignRole($cajero, 'cajero');

        // Crear un usuario de marketing
        $marketing = Usuario::create([
            'nombre' => 'Marketing',
            'email' => 'marketing@example.com',
            'password' => bcrypt('password'),
        ]);
        $this->assignRole($marketing, 'marketing');

        // Crear un usuario cliente normal
        $clienteNormal = Usuario::create([
            'nombre' => 'Cliente Normal',
            'email' => 'cliente@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $this->assignRole($clienteNormal, 'cliente');

        // Crear un usuario cliente VIP
        $clienteVip = Usuario::create([
            'nombre' => 'Cliente VIP',
            'email' => 'vip@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $this->assignRole($clienteVip, 'cliente_vip');
    }

    // Función para asignar roles a usuarios
    private function assignRole($usuario, $nombreRol)
    {
        $rol = Role::where('nombre', $nombreRol)->first();
        $usuario->roles()->attach($rol);
    }
}
