<?php

namespace App\Models;

class Sucursal
{
    public ?int $idSucursal;
    public string $nombreSucursal;
    public string $calle;
    public string $colonia;
    public int $numero;
    public int $CP;
    public string $telefono;
    public int $idStatus;

    public function __construct(?int $idSucursal, string $nombreSucursal, string $calle, string $colonia, int $numero, int $CP, string $telefono, int $idStatus)
    {
        $this->idSucursal = $idSucursal;
        $this->nombreSucursal = $nombreSucursal;
        $this->calle = $calle;
        $this->colonia = $colonia;
        $this->numero = $numero;
        $this->CP = $CP;
        $this->telefono = $telefono;
        $this->idStatus = $idStatus;
    }

    // Métodos getters para cada propiedad
    public function getIdSucursal(): ?int { return $this->idSucursal; }
    public function getNombreSucursal(): string { return $this->nombreSucursal; }
    public function getCalle(): string { return $this->calle; }
    public function getColonia(): string { return $this->colonia; }
    public function getNumero(): int { return $this->numero; }
    public function getCP(): int { return $this->CP; }
    public function getTelefono(): string { return $this->telefono; }
    public function getIdStatus(): int { return $this->idStatus;}
}