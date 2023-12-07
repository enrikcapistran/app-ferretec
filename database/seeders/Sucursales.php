<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Sucursales extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sucursal::create([
            'idSucursal' => '1',
            'nombreSucursal' => 'Sucursal NORTE',
            'calle' => 'Av. 1',
            'colonia' => 'Morelos',
            'numero' => '1612',
            'CP' => '31000',
            'telefono' => '6671000000',
            'idStatus' => '1',
        ]);

        Sucursal::create([
            'idSucursal' => '2',
            'nombreSucursal' => 'Sucursal ESTE',
            'calle' => 'Av. 2',
            'colonia' => 'Carranza',
            'numero' => '7644',
            'CP' => '30449',
            'telefono' => '6671000000',
            'idStatus' => '1',
        ]);

        Sucursal::create([
            'idSucursal' => '3',
            'nombreSucursal' => 'Sucursal SUR',
            'calle' => 'Av. 3',
            'colonia' => 'Cortinez',
            'numero' => '2469',
            'CP' => '38681',
            'telefono' => '6671000000',
            'idStatus' => '1',
        ]);

        Sucursal::create([
            'idSucursal' => '4',
            'nombreSucursal' => 'Sucursal OESTE',
            'calle' => 'Av. 4',
            'colonia' => 'Centro',
            'numero' => '182',
            'CP' => '84112',
            'telefono' => '6671000000',
            'idStatus' => '1',
        ]);
    }
}
