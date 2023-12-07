<?php

namespace App\Models;

class Producto
{
    public ?int $idProducto;
    public string $nombreProductos;
    public string $descripcion;
    public string $imagen;
    public float $precioUnitario;
    public int $idTipoProducto;
    public int $idStatus;

    public function __construct(?int $idProducto, string $nombreProductos, string $descripcion, string $imagen, float $precioUnitario, int $idTipoProducto, int $idStatus)
    {
        $this->idProducto = $idProducto;
        $this->nombreProductos = $nombreProductos;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen; 
        $this->precioUnitario = $precioUnitario;
        $this->idTipoProducto = $idTipoProducto;
        $this->idStatus = $idStatus;
    }

    public function getIdProducto(): ?int { return $this->idProducto; }
    public function getNombreProductos(): string { return $this->nombreProductos; }
    public function getDescripcion(): string { return $this->descripcion; }
    public function getImagen(): string { return $this->imagen; }
    public function getPrecioUnitario(): float { return $this->precioUnitario; }
    public function getIdTipoProducto(): int { return $this->idTipoProducto; }
    public function getIdStatus(): int { return $this->idStatus; }

}
