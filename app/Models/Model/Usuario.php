<?php

namespace App\Models;

class Usuario
{
    public ?int $id;
    public string $email;
    public string $password;
    public string $apellidoPaterno;
    public string $apellidoMaterno;
    public string $nombre;
    public string $fechaNacimiento;
    public int $idRol;
    public int $idStatus;

    public function __construct(?int $id, string $email, string $password, string $apellidoPaterno, string $apellidoMaterno, string $nombre, string $fechaNacimiento, int $idRol, int $idStatus)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->apellidoPaterno = $apellidoPaterno;
        $this->apellidoMaterno = $apellidoMaterno;
        $this->nombre = $nombre;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->idRol = $idRol;
        $this->idStatus = $idStatus;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getApellidoPaterno(): string
    {
        return $this->apellidoPaterno;
    }
    public function getApellidoMaterno(): string
    {
        return $this->apellidoMaterno;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getFechaNacimiento(): string
    {
        return $this->fechaNacimiento;
    }
    public function getIdRol(): int
    {
        return $this->idRol;
    }
}
