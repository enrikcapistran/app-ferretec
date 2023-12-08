<?php

namespace App\Models;

class Almacen
{
    public ?int $idAlmacen;
    public string $nombreAlmacen;
    public string $calle;
    public string $colonia;
    public int $numero;
    public int $CP;
    public int $idStatus;

    public function __construct(?int $idAlmacen, string $nombreAlmacen, string $calle, string $colonia, int $numero, int $CP, int $idStatus)
    {
        $this->idAlmacen = $idAlmacen;
        $this->nombreAlmacen = $nombreAlmacen;
        $this->calle = $calle;
        $this->colonia = $colonia;
        $this->numero = $numero;
        $this->CP = $CP;
        $this->idStatus = $idStatus;
    }

    public function getIdAlmacen(): ?int { return $this->idAlmacen; }
    public function getNombreAlmacen(): string { return $this->nombreAlmacen; }
    public function getCalle(): string { return $this->calle; }
    public function getColonia(): string { return $this->colonia; }
    public function getNumero(): int { return $this->numero; }
    public function getCP(): int { return $this->CP; }
    public function getIdStatus(): int { return $this->idStatus; }
}
