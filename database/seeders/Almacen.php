<?php

namespace Database\Seeders;

use App\Models\Almacen;
use Illuminate\Database\Seeder;

class Almacen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Datos de muestra para almacenes
        $almacenes = [
            [
                'nombreAlmacen' => 'Almacén Principal',
                'calle' => 'Calle Principal',
                'colonia' => 'Centro',
                'numero' => 123,
                'CP' => 12345,
            ],
        ];

        foreach ($almacenes as $almacenData) {
            Almacen::create($almacenData);
        }
    }
}
