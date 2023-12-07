<?php

namespace App\Models\Clases;

class Refaccion
{
    public int $idProducto;
    public string $SKU;
    public int $idStatus;

    public function __construct(int $idProducto, string $SKU, int $idStatus)
    {
        $this->idProducto = $idProducto;
        $this->SKU = $SKU;
        $this->idStatus = $idStatus;
    }

    // Métodos getters para cada propiedad
    public function getIdProducto(): int
    {
        return $this->idProducto;
    }
    public function getSKU(): string
    {
        return $this->SKU;
    }
    public function getIdStatus(): int
    {
        return $this->idStatus;
    }

    // Métodos setters si los necesitas
    // Métodos para lógica de negocio específica de refacciones
}
