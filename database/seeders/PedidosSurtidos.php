<?php

namespace Database\Seeders;

use App\Models\PedidoSurtido;
use Illuminate\Database\Seeder;

class PedidosSurtidos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pedidosSurtidos = [
            ['1', '2023-01-01 12:00:00', '1'],
            ['2', '2023-01-02 14:30:00', '1'],
            ['1', '2023-01-03 16:45:00', '1'],
            ['2', '2023-01-04 18:20:00', '1'],
            ['1', '2023-01-05 20:40:00', '1'],
        ];

        foreach ($pedidosSurtidos as $pedidoSurtido) {
            PedidoSurtido::create([
                'idSucursal' => $pedidoSurtido[1],
                'fechaDePedido' => $pedidoSurtido[2],
                'idStatus' => $pedidoSurtido[4],
            ]);
        }
    }
}
