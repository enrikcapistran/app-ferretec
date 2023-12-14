<?php

namespace App\Models\Clases;

class DetalleCarrito
{
    private ?int $idDetalleCarrito;
    private ?int $idCarrito;
    private Producto $producto;
    private int $cantidad;
    private int $idStatus;


    public function __construct(?int $idCarrito, Producto $producto, int $cantidad, int $idDetalleCarrito = null, int $idStatus = 1)
    {
        $this->idCarrito = $idCarrito;
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->idStatus = $idStatus;
        $this->idDetalleCarrito = $idDetalleCarrito;
    }

    public function getIdCarrito(): ?int
    {
        return $this->idCarrito;
    }
    public function getProducto(): Producto
    {
        return $this->producto;
    }
    public function getIdStatus(): int
    {
        return $this->idStatus;
    }

    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    public function getIdDetalleCarrito(): ?int
    {
        return $this->idDetalleCarrito;
    }

    //setters

    public function setIdCarrito(int $idCarrito): void
    {
        $this->idCarrito = $idCarrito;
    }

    public function setProducto(Producto $producto): void
    {
        $this->producto = $producto;
    }

    public function setCantidad(int $cantidad): void
    {
        $this->cantidad = $cantidad;
    }

    public function setIdStatus(int $idStatus): void
    {
        $this->idStatus = $idStatus;
    }

    public function setIdDetalleCarrito(int $idDetalleCarrito): void
    {
        $this->idDetalleCarrito = $idDetalleCarrito;
    }

    public function calcularSubtotal(): float
    {
        return $this->producto->getPrecioUnitario() * $this->cantidad;
    }

    public function getSubtotal()
    {
        return $this->producto->getPrecioUnitario() * $this->cantidad;
    }
}
