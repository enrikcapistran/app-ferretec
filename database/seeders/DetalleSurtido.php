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
        // Datos de muestra para 5 detalles de surtido
        $detallesSurtidos = [
            ['1', '1', '10'],
            ['1', '2', '5'],
            ['2', '3', '8'],
            ['2', '4', '15'],
            ['2', '5', '12'],
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
