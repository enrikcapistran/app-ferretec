<?php

namespace App\Models;

class Usuario
{
    public ?int $id;
    public string $correoElectronico;
    public string $contraseña;
    public string $apellidoPaterno;
    public string $apellidoMaterno;
    public string $nombre;
    public string $fechaNacimiento;
    public int $idRol;
    public int $idStatus;

    public function __construct(?int $id, string $correoElectronico, string $contraseña, string $apellidoPaterno, string $apellidoMaterno, string $nombre, string $fechaNacimiento, int $idRol, int $idStatus)
    {
        $this->id = $id;
        $this->correoElectronico = $correoElectronico;
        $this->contraseña = $contraseña;
        $this->apellidoPaterno = $apellidoPaterno;
        $this->apellidoMaterno = $apellidoMaterno;
        $this->nombre = $nombre;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->idRol = $idRol;
        $this->idStatus = $idStatus;
    }

    public function getId(): ?int { return $this->id; }
    public function getCorreoElectronico(): string { return $this->correoElectronico; }
    public function getContraseña(): string { return $this->contraseña; }
    public function getApellidoPaterno(): string { return $this->apellidoPaterno; }
    public function getApellidoMaterno(): string { return $this->apellidoMaterno; }
    public function getNombre(): string { return $this->nombre; }
    public function getFechaNacimiento(): string { return $this->fechaNacimiento; }
    public function getIdRol(): int { return $this->idRol; }
}