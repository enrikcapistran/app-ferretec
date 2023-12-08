<?php

namespace App\Models;

class PedidoSurtido
{
    public ?int $idSurtido;
    public int $idAlmacen;
    public int $idSucursal;
    public string $fechaDePedido;
    public string $fechaDeRecibido;
    public int $idStatus;

    public function __construct(?int $idSurtido, int $idAlmacen, int $idSucursal, string $fechaDePedido, string $fechaDeRecibido, int $idStatus)
    {
        $this->idSurtido = $idSurtido;
        $this->idAlmacen = $idAlmacen;
        $this->idSucursal = $idSucursal;
        $this->fechaDePedido = $fechaDePedido;
        $this->fechaDeRecibido = $fechaDeRecibido;
        $this->idStatus = $idStatus;
    }
}
