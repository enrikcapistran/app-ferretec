<?php

namespace App\Models\Clases;

class Producto
{
    protected ?int $idProducto;
    protected string $nombreProducto;
    protected string $descripcion;
    protected string $imagen;
    protected float $precioUnitario;
    protected int $idTipoProducto;
    protected ?Status $status;

    public function __construct(?int $idProducto, string $nombreProducto, string $descripcion, string $imagen, float $precioUnitario, int $idTipoProducto, Status $status = new Status(1))
    {
        $this->idProducto = $idProducto;
        $this->nombreProducto = $nombreProducto;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->precioUnitario = $precioUnitario;
        $this->idTipoProducto = $idTipoProducto;
        $this->status = $status;
    }

    public function getIdProducto(): ?int
    {
        return $this->idProducto;
    }
    public function getnombreProducto(): string
    {
        return $this->nombreProducto;
    }
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }
    public function getImagen(): string
    {
        return $this->imagen;
    }
    public function getPrecioUnitario(): float
    {
        return $this->precioUnitario;
    }
    public function getIdTipoProducto(): int
    {
        return $this->idTipoProducto;
    }
    public function getstatus(): Status
    {
        return $this->status;
    }

    //setters
    public function setIdProducto(int $idProducto): void
    {
        $this->idProducto = $idProducto;
    }
    public function setnombreProducto(string $nombreProducto): void
    {
        $this->nombreProducto = $nombreProducto;
    }
    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }
    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }
    public function setPrecioUnitario(float $precioUnitario): void
    {
        $this->precioUnitario = $precioUnitario;
    }
    public function setIdTipoProducto(int $idTipoProducto): void
    {
        $this->idTipoProducto = $idTipoProducto;
    }
    public function setstatus(Status $status): void
    {
        $this->status = $status;
    }
}
