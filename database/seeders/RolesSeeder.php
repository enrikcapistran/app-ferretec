<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $roles = ['admin', 'cajero', 'marketing', 'cliente', 'cliente_vip'];

        foreach ($roles as $role) {
            Role::create(['nombre' => $role]);
        }
    }
}