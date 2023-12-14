<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetallesPedidosSurtidos;

class DetallesPedidosSurtido extends Seeder
{

    public function run()
    {
        $detallesPedidosSurtidos = [
            ['idSurtido' => 1, 'idRefaccion' => 1, 'cantidad' => 10],
            ['idSurtido' => 1, 'idRefaccion' => 2, 'cantidad' => 5],

            ['idSurtido' => 2, 'idRefaccion' => 3, 'cantidad' => 8],
            ['idSurtido' => 2, 'idRefaccion' => 1, 'cantidad' => 15],
            ['idSurtido' => 2, 'idRefaccion' => 4, 'cantidad' => 12],

            ['idSurtido' => 3, 'idRefaccion' => 3, 'cantidad' => 1],
            ['idSurtido' => 3, 'idRefaccion' => 4, 'cantidad' => 2],
            ['idSurtido' => 3, 'idRefaccion' => 5, 'cantidad' => 12],
            ['idSurtido' => 3, 'idRefaccion' => 7, 'cantidad' => 17],
            ['idSurtido' => 3, 'idRefaccion' => 8, 'cantidad' => 19],

            ['idSurtido' => 4, 'idRefaccion' => 1, 'cantidad' => 11],
            ['idSurtido' => 4, 'idRefaccion' => 5, 'cantidad' => 10],

            ['idSurtido' => 5, 'idRefaccion' => 3, 'cantidad' => 23],
            ['idSurtido' => 5, 'idRefaccion' => 4, 'cantidad' => 34],
            ['idSurtido' => 5, 'idRefaccion' => 5, 'cantidad' => 19],
            ['idSurtido' => 5, 'idRefaccion' => 6, 'cantidad' => 23],


        ];

        foreach ($detallesPedidosSurtidos as $detalle) {
            DetallesPedidosSurtidos::create([
                'idSurtido' => $detalle['idSurtido'],
                'idRefaccion' => $detalle['idRefaccion'],
                'cantidad' => $detalle['cantidad'],
            ]);
        }
    }
}
