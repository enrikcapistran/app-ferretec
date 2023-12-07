<?php

namespace App\Models\Clases;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public ?int $folio;
    public int $idSucursal;
    public int $idEmpleado;
    public int $idCliente;
    public int $idPago;
    public string $fechaVenta;
    public float $totalPago;
    public int $idStatus;

    public function __construct(?int $folio, int $idSucursal, int $idEmpleado, int $idCliente, int $idPago, string $fechaVenta, float $totalPago, int $idStatus)
    {
        $this->folio = $folio;
        $this->idSucursal = $idSucursal;
        $this->idEmpleado = $idEmpleado;
        $this->idCliente = $idCliente;
        $this->idPago = $idPago;
        $this->fechaVenta = $fechaVenta;
        $this->totalPago = $totalPago;
        $this->idStatus = $idStatus;
    }

    public function getFolio(): ?int
    {
        return $this->folio;
    }
    public function getIdSucursal(): int
    {
        return $this->idSucursal;
    }
    public function getIdEmpleado(): int
    {
        return $this->idEmpleado;
    }
    public function getIdCliente(): int
    {
        return $this->idCliente;
    }
    public function getIdPago(): int
    {
        return $this->idPago;
    }
    public function getFechaVenta(): string
    {
        return $this->fechaVenta;
    }
    public function getTotalPago(): float
    {
        return $this->totalPago;
    }
    public function getIdStatus(): int
    {
        return $this->idStatus;
    }
}
