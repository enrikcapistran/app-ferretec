<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(Status::class);
        $this->call(Roles::class);
        $this->call(TipoDeProductos::class);
        $this->call(Sucursales::class);
        $this->call(ProductosRefacciones::class);
        $this->call(Usuarios::class);
        $this->call(Almacen::class);
        $this->call(PedidosSurtidos::class);
        $this->call(DetallesPedidosSurtido::class);
        $this->call(InventarioSucursales::class);
    }
}
