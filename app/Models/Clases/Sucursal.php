<?php

namespace App\Models\Clases;

class Sucursal
{
    public ?int $idSucursal;
    public string $nombreSucursal;
    public string $calle;
    public string $colonia;
    public int $numero;
    public int $CP;
    public string $telefono;
    public Status $status;

    public function __construct()
    {
    }

    // Métodos getters para cada propiedad
    public function getIdSucursal(): ?int
    {
        return $this->idSucursal;
    }
    public function getNombreSucursal(): string
    {
        return $this->nombreSucursal;
    }
    public function getCalle(): string
    {
        return $this->calle;
    }
    public function getColonia(): string
    {
        return $this->colonia;
    }
    public function getNumero(): int
    {
        return $this->numero;
    }
    public function getCP(): int
    {
        return $this->CP;
    }
    public function getTelefono(): string
    {
        return $this->telefono;
    }
    public function getIdStatus(): Status
    {
        return $this->status;
    }

    //setters
    public function setIdSucursal(int $idSucursal): void
    {
        $this->idSucursal = $idSucursal;
    }
    public function setNombreSucursal(string $nombreSucursal): void
    {
        $this->nombreSucursal = $nombreSucursal;
    }
    public function setCalle(string $calle): void
    {
        $this->calle = $calle;
    }
    public function setColonia(string $colonia): void
    {
        $this->colonia = $colonia;
    }
    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }
    public function setCP(int $CP): void
    {
        $this->CP = $CP;
    }
    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }
    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }
}
