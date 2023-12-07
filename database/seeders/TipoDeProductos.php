<?php

namespace Database\Seeders;

use App\Models\TipoProducto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TipoDeProductos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoProducto::create([
            'idTipoProducto' => '1',
            'tipoDeProducto' => 'Refaccion',
        ]);

        TipoProducto::create([
            'idTipoProducto' => '2',
            'tipoDeProducto' => 'Kit',
        ]);
    }
}
