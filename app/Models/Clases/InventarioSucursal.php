<?php

namespace App\Models\Clases;
class InventarioSucursal
{
    public int $idSucursal;
    public int $idProducto;
    public int $existencia;
    public int $stockMaximo;
    public int $stockMinimo;
    public int $idStatus;

    public function __construct(int $idSucursal, int $idProducto, int $existencia, int $stockMaximo, int $stockMinimo, int $idStatus)
    {
        $this->idSucursal = $idSucursal;
        $this->idProducto = $idProducto;
        $this->existencia = $existencia;
        $this->stockMaximo = $stockMaximo;
        $this->stockMinimo = $stockMinimo;
        $this->idStatus = $idStatus;
    }

    public function getIdSucursal(): int { return $this->idSucursal; }
    public function getIdProducto(): int { return $this->idProducto; }
    public function getExistencia(): int { return $this->existencia; }
    public function getStockMaximo(): int { return $this->stockMaximo; }
    public function getStockMinimo(): int { return $this->stockMinimo; }
    public function getIdStatus(): int { return $this->idStatus; }
}
