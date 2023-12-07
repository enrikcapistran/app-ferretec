<?php

namespace App\Models\Modelos;

use App\Models\Clases\Kit;
use App\Models\Clases\Status;
use App\Models\Clases\Producto;
use App\Models\Clases\Sucursal;

use App\Models\Kit as kitServicios;
use App\Models\Producto as productoServicios;

class KitModelo
{

    protected ?Kit $kit;
    private $kitServicios;

    public function __construct(Kit $kit = null)
    {
        $this->kit = session()->get('kit') ?? $kit;
    }

    public function iniciarNuevoKit()
    {
        $this->kit = new Kit();
        session()->put('kit', $this->kit) ?? new Kit();
    }

    public function añadirRefaccion($idRefaccion, $cantidad)
    {
        $bool = $this->kit->añadirRefaccion($idRefaccion, $cantidad);
        session()->put('kit', $this->kit);
        return $bool;
    }

    public function eliminarRefaccion($idRefaccion)
    {
        $this->kit->eliminarRefaccion($idRefaccion);
        session()->put('kit', $this->kit);
    }

    public function setInformacion($nombreProducto, $descripcion, $precioUnitario, $imagen, $idSucursal)
    {
        $this->kit->setNombreProducto($nombreProducto);
        $this->kit->setDescripcion($descripcion);
        $this->kit->setPrecioUnitario($precioUnitario);
        $this->kit->setImagen($imagen);
        $sucursal = new Sucursal();
        $sucursal->setIdSucursal($idSucursal);
        $this->kit->setSucursal($sucursal);
        session()->put('kit', $this->kit);
    }

    public function getKit(): Kit
    {
        return $this->kit;
    }

    public function grabarKit()
    {

        $producto = productoServicios::create([
            'nombreProducto' => $this->kit->getNombreProducto(),
            'descripcion' => $this->kit->getDescripcion(),
            'imagen' => $this->kit->getImagen(),
            'precioUnitario' => $this->kit->getPrecioUnitario(),
            'idTipoProducto' => $this->kit->getIdTipoProducto(),
            'idSucursal' => $this->kit->getSucursal()->getIdSucursal(),
            'idUsuarioCreador' => $this->kit->getUsuarioCreador()->getIdUsuario(),
            'idStatus' => $this->kit->getStatus()->getIdStatus(),
        ]);


        kitServicios::create([
            'idProducto' => $producto->idProducto,
            'idSucursal' => $this->kit->getSucursal()->getIdSucursal(),
            'idUsuarioCreador' => $this->kit->getUsuarioCreador()->getIdUsuario(),
            'idStatus' => $this->kit->getStatus()->getIdStatus(),
        ]);

        session()->forget('kit');
    }

    public function obtenerKitsEnDiseño()
    {
        $kitsEnDiseño = productoServicios::all()->where('idTipoProducto', '=', 2)->where('idStatus', '=', 11);

        $kitsObj = $kitsEnDiseño->map(function ($kitEloquent) {
            $status = new Status($kitEloquent->status->idStatus, $kitEloquent->status->nombreStatus); // Asumiendo que tienes una clase Status y constructor adecuado

            return new Producto(
                $kitEloquent->idProducto,
                $kitEloquent->nombreProducto,
                $kitEloquent->descripcion,
                $kitEloquent->imagen,
                $kitEloquent->precioUnitario,
                $kitEloquent->idTipoProducto,
                $status
            );
        });

        return $kitsObj;
    }
}
