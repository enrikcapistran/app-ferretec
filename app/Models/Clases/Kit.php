<?php

namespace App\Models\Clases;


use function PHPSTORM_META\map;

class Kit extends Producto
{
    private ?Sucursal $sucursal = null;
    private ?Usuario $usuarioCreador = null;
    private ?Usuario $usuarioAutorizador = null;

    private array $detallesKit;

    public function __construct(?Usuario $usuarioCreador = null)
    {
        $this->detallesKit = [];
        $this->status = new Status(11, "en Diseño");
        $this->idTipoProducto = 2;
        $this->sucursal = null;
        $this->nombreProducto = "";
        $this->descripcion = "";
        $this->imagen = "";
        $this->precioUnitario = 0;

        $usr =  new Usuario();
        $usr->setIdUsuario(auth()->user()->idUsuario);

        $this->usuarioCreador = $usuarioCreador ?? $usr;
    }


    public function getSucursal(): ?Sucursal
    {
        return $this->sucursal;
    }

    public function getUsuarioCreador(): ?Usuario
    {
        return $this->usuarioCreador;
    }
    public function getUsuarioAutorizador(): ?Usuario
    {
        return $this->usuarioAutorizador;
    }


    //setters

    public function setSucursal(Sucursal $sucursal): void
    {
        $this->sucursal = $sucursal;
    }
    public function setUsuarioCreador(Usuario $usuarioCreador): void
    {
        $this->usuarioCreador = $usuarioCreador;
    }
    public function setUsuarioAutorizador(?Usuario $usuarioAutorizador): void
    {
        $this->usuarioAutorizador = $usuarioAutorizador;
    }

    public function añadirRefaccion(string $idRefaccion, int $cantidad): bool
    {

        for ($i = 1; $i < count($this->detallesKit); $i++) {
            if ($this->detallesKit[$i]->getIdRefaccion() == $idRefaccion) {
                // $this->detallesKit[$i]->setCantidad($this->detallesKit[$i]->getCantidad() + $cantidad);
                return false;
            }
        }

        $detalleKit = new DetalleKit();
        $detalleKit->setIdRefaccion($idRefaccion);
        $detalleKit->setCantidad($cantidad);

        array_push($this->detallesKit, $detalleKit);
        return true;
    }

    public function eliminarRefaccion(string $idRefaccion)
    {
        $this->detallesKit = array_filter($this->detallesKit, function ($detalleKit) use ($idRefaccion) {
            return $detalleKit->getIdRefaccion() != $idRefaccion;
        });

        $this->detallesKit = array_values($this->detallesKit);
    }

    public function getDetallesKit(): array
    {
        return $this->detallesKit;
    }

    public function setDetallesKit(array $detallesKit): void
    {
        $this->detallesKit = $detallesKit;
    }
}
