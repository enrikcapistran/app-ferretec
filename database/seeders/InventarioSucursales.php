<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\InventarioSucursal;

class InventarioSucursales extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = [
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
            ['1', '50', '100', '10'],
        ];

        foreach ($productos as $producto) {
            InventarioSucursal::create([
                'idSucursal' => 1,
                'idProducto' => $producto[0],
                'existencia' => $producto[1],
                'stockMaximo' => $producto[2],
                'stockMinimo' => $producto[3],
            ]);

            InventarioSucursal::create([
                'idSucursal' => 2,
                'idProducto' => $producto[0],
                'existencia' => $producto[1],
                'stockMaximo' => $producto[2],
                'stockMinimo' => $producto[3],
            ]);

            InventarioSucursal::create([
                'idSucursal' => 3,
                'idProducto' => $producto[0],
                'existencia' => $producto[1],
                'stockMaximo' => $producto[2],
                'stockMinimo' => $producto[3],
            ]);

            InventarioSucursal::create([
                'idSucursal' => 4,
                'idProducto' => $producto[0],
                'existencia' => $producto[1],
                'stockMaximo' => $producto[2],
                'stockMinimo' => $producto[3],
            ]);
        }
    }
}
