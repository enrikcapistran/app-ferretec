<?php

namespace App\Models\Modelos;

class DetalleSurtido
{
    public ?int $idSurtidoDetalle;
    public int $idSurtido;
    public int $idRefaccion;
    public int $cantidad;
    public string $creadoEn;
    public string $actualizadoEn;

    public function __construct(?int $idSurtidoDetalle, int $idSurtido, int $idRefaccion, int $cantidad, string $creadoEn, string $actualizadoEn)
    {
        $this->idSurtidoDetalle = $idSurtidoDetalle;
        $this->idSurtido = $idSurtido;
        $this->idRefaccion = $idRefaccion;
        $this->cantidad = $cantidad;
        $this->creadoEn = $creadoEn;
        $this->actualizadoEn = $actualizadoEn;
    }
}
