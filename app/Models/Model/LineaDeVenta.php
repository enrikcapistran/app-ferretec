<?php

namespace App\Models;

class LineaDeVenta
{
    public ?int $idLineaDeVenta;
    public int $idVenta;
    public ?int $idProducto;
    public int $cantidad;
    public float $precioUnitario;
    public int $idStatus;


    public function __construct(?int $idLineaDeVenta, int $idVenta, ?int $idProducto, int $cantidad, float $precioUnitario, int $idStatus)
    {
        $this->idLineaDeVenta = $idLineaDeVenta;
        $this->idVenta = $idVenta;
        $this->idProducto = $idProducto;
        $this->cantidad = $cantidad;
        $this->precioUnitario = $precioUnitario;
        $this->idStatus = $idStatus;

    }

    // Métodos getters para cada propiedad
    public function getIdLineaDeVenta(): ?int { return $this->idLineaDeVenta; }
    public function getIdVenta(): int { return $this->idVenta; }
    public function getIdProducto(): ?int { return $this->idProducto; }
    public function getCantidad(): int { return $this->cantidad; }
    public function getPrecioUnitario(): float { return $this->precioUnitario; }
    public function getIdStatus(): int { return $this->idStatus; }
}
