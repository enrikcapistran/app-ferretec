<?php

namespace Database\Seeders;

use App\Models\DetalleSurtido;
use Illuminate\Database\Seeder;

class DetallesSurtidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detallesSurtidos = [
            ['1', '1', '10'],
            ['1', '2', '5'],
            ['2', '3', '8'],
            ['2', '1', '15'],
            ['2', '1', '12'],
        ];

        foreach ($detallesSurtidos as $detalleSurtido) {
            DetalleSurtido::create([
                'idSurtido' => $detalleSurtido[0],
                'idRefaccion' => $detalleSurtido[1],
                'cantidad' => $detalleSurtido[2],
            ]);
        }
    }
}
