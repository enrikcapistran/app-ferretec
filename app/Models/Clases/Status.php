<?php

namespace App\Models\Clases;

class Status
{
    public ?int $idStatus;
    public string $nombreStatus;



    public function __construct($idStatus, $nombreStatus)
    {
        $this->idStatus = $idStatus;
        $this->nombreStatus = $nombreStatus;
    }

    // Métodos getters y setters para cada propiedad
    public function getIdStatus(): ?int
    {
        return $this->idStatus;
    }
    public function getNombreStatus(): string
    {
        return $this->nombreStatus;
    }
}
