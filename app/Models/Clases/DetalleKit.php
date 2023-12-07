<?php

namespace App\Models\Clases;

class DetalleKit
{
    public int $idKit;
    public int $idRefaccion;
    public int $cantidad;

    public function __construct()
    {
    }

    public function getIdKit(): int
    {
        return $this->idKit;
    }
    public function getIdRefaccion(): int
    {
        return $this->idRefaccion;
    }
    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    //setters
    public function setIdKit(int $idKit): void
    {
        $this->idKit = $idKit;
    }
    public function setIdRefaccion(int $idRefaccion): void
    {
        $this->idRefaccion = $idRefaccion;
    }
    public function setCantidad(int $cantidad): void
    {
        $this->cantidad = $cantidad;
    }
}
