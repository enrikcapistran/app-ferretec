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
        $productos1 = [
            ['1', '10', '100', '10'],

            ['3', '10', '100', '10'],

            ['5', '10', '100', '10'],

            ['7', '10', '100', '10'],

            ['9', '10', '100', '10'],

            ['11', '10', '100', '10'],

            ['13', '10', '100', '10'],

            ['15', '10', '100', '10'],
        ];

        $productos2 = [

            ['2', '20', '100', '10'],

            ['4', '20', '100', '10'],

            ['6', '20', '100', '10'],

            ['8', '20', '100', '10'],

            ['10', '20', '100', '10'],

            ['12', '20', '100', '10'],

            ['14', '20', '100', '10'],

        ];

        $productos3 = [
            ['8', '30', '100', '10'],
            ['9', '30', '100', '10'],
            ['10', '30', '100', '10'],
            ['11', '30', '100', '10'],
            ['12', '30', '100', '10'],
            ['13', '30', '100', '10'],
            ['14', '30', '100', '10'],
            ['15', '30', '100', '10'],
        ];

        $productos4 = [
            ['1', '40', '100', '10'],
            ['2', '40', '100', '10'],
            ['3', '40', '100', '10'],
            ['4', '40', '100', '10'],
            ['5', '40', '100', '10'],
            ['6', '40', '100', '10'],
            ['7', '40', '100', '10'],
            ['8', '40', '100', '10'],
        ];


        foreach ($productos1 as $producto) {
            InventarioSucursal::create([
                'idSucursal' => 1,
                'idProducto' => $producto[0],
                'existencia' => $producto[1],
                'stockMaximo' => $producto[2],
                'stockMinimo' => $producto[3],
            ]);
        }

        foreach ($productos2 as $producto) {
            InventarioSucursal::create([
                'idSucursal' => 2,
                'idProducto' => $producto[0],
                'existencia' => $producto[1],
                'stockMaximo' => $producto[2],
                'stockMinimo' => $producto[3],
            ]);
        }

        foreach ($productos3 as $producto) {
            InventarioSucursal::create([
                'idSucursal' => 3,
                'idProducto' => $producto[0],
                'existencia' => $producto[1],
                'stockMaximo' => $producto[2],
                'stockMinimo' => $producto[3],
            ]);
        }

        foreach ($productos4 as $producto) {
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
