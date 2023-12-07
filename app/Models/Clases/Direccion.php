<?php

namespace App\Models\Clases;

class Direccion
{
    public ?int $idDireccion;
    public int $idUsuario;
    public string $calle;
    public string $colonia;
    public int $numero;
    public int $CP;
    public string $referencia;
    public string $telefono;
    public int $idStatus;

    public function __construct(?int $idDireccion, int $idUsuario, string $calle, string $colonia, int $numero, int $CP, string $referencia, string $telefono, int $idStatus)
    {
        $this->idDireccion = $idDireccion;
        $this->idUsuario = $idUsuario;
        $this->calle = $calle;
        $this->colonia = $colonia;
        $this->numero = $numero;
        $this->CP = $CP;
        $this->referencia = $referencia;
        $this->telefono = $telefono;
        $this->idStatus = $idStatus;
    }

    public function getIdDireccion(): ?int { return $this->idDireccion; }
    public function getIdUsuario(): int { return $this->idUsuario; }
    public function getCalle(): string { return $this->calle; }
    public function getColonia(): string { return $this->colonia; }
    public function getNumero(): int { return $this->numero; }
    public function getCP(): int { return $this->CP; }
    public function getReferencia(): string { return $this->referencia; }
    public function getTelefono(): string { return $this->telefono; }
    public function getIdStatus(): int { return $this->idStatus; }

}

