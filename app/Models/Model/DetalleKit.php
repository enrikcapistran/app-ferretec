<?php

namespace App\Models;

class DetalleKit
{
    public int $idKit;
    public int $idRefaccion;
    public int $cantidad;

    public function __construct(int $idKit, int $idRefaccion, int $cantidad)
    {
        $this->idKit = $idKit;
        $this->idRefaccion = $idRefaccion;
        $this->cantidad = $cantidad;
    }

    public function getIdKit(): int { return $this->idKit; }
    public function getIdRefaccion(): int { return $this->idRefaccion; }
    public function getCantidad(): int { return $this->cantidad; }

}
