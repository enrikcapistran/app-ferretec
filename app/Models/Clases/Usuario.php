<?php

namespace App\Models\Clases;

class Usuario
{
    public ?int $idUsuario;
    public string $email;
    public string $password;
    public string $apellidoPaterno;
    public string $apellidoMaterno;
    public string $nombre;
    public string $fechaNacimiento;
    public int $idRol;
    public int $idStatus;

    public function __construct()
    {
    }

    public function getIdUsuario(): ?int
    {
        return $this->idUsuario;
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

    //setters
    public function setIdUsuario(int $idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setApellidoPaterno(string $apellidoPaterno): void
    {
        $this->apellidoPaterno = $apellidoPaterno;
    }
    public function setApellidoMaterno(string $apellidoMaterno): void
    {
        $this->apellidoMaterno = $apellidoMaterno;
    }
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
    public function setFechaNacimiento(string $fechaNacimiento): void
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }
    public function setIdRol(int $idRol): void
    {
        $this->idRol = $idRol;
    }
}
