<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(Status::class);
        $this->call(Roles::class);
        $this->call(TipoDeProductos::class);
        $this->call(Sucursales::class);
        $this->call(ProductosRefacciones::class);
        $this->call(Usuarios::class);
        $this->call(DetalleSurtido::class);
        $this->call(PedidosSurtidos::class);
        $this->call(Almacen::class);

    }
}
