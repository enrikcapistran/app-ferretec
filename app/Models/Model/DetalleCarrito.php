<?php

namespace App\Models;

class DetalleCarrito
{
    public ?int $idCarrito;
    public int $idUsuario;
    public int $idStatus;


    public function __construct(?int $idCarrito, int $idUsuario, int $idStatus)
    {
        $this->idCarrito = $idCarrito;
        $this->idUsuario = $idUsuario;
        $this->idStatus = $idStatus;

    }

    public function getIdCarrito(): ?int { return $this->idCarrito; }
    public function getIdUsuario(): int { return $this->idUsuario; }
    public function getIdStatus(): int { return $this->idStatus; }
}
