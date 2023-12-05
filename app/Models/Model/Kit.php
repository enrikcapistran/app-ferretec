<?php

namespace App\Models;

class Kit
{
    public int $idProducto;
    public int $idSucursal;
    public int $idUsuarioCreador;
    public ?int $idUsuarioAutorizador;
    public int $idStatus;

    public function __construct(int $idProducto, int $idSucursal, int $idUsuarioCreador, ?int $idUsuarioAutorizador, int $idStatus)
    {
        $this->idProducto = $idProducto;
        $this->idSucursal = $idSucursal;
        $this->idUsuarioCreador = $idUsuarioCreador;
        $this->idUsuarioAutorizador = $idUsuarioAutorizador;
        $this->idStatus = $idStatus;
    }

    public function getIdProducto(): int { return $this->idProducto; }
    public function getIdSucursal(): int { return $this->idSucursal; }
    public function getIdUsuarioCreador(): int { return $this->idUsuarioCreador; }
    public function getIdUsuarioAutorizador(): ?int { return $this->idUsuarioAutorizador; }
    public function getIdStatus(): int { return $this->idStatus; }

}
