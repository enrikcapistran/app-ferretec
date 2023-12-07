<?php

namespace App\Models\Modelos;

use App\Models\Clases\Sucursal;
use App\Models\Sucursal as SucursalServicios;

use function PHPSTORM_META\map;

class SucursalModelo
{
    private SucursalServicios $sucursalServicios;

    public function __construct()
    {
        $this->sucursalServicios = new SucursalServicios();
    }

    public function getTodasSucursales()
    {
        $sucursalesJson = $this->sucursalServicios->all();

        $sucursalesArr = $sucursalesJson->map(function ($sucursal) {
            $sucursalObj = new Sucursal();

            $sucursalObj->setIdSucursal($sucursal->idSucursal);
            $sucursalObj->setNombreSucursal($sucursal->nombreSucursal);
            $sucursalObj->setCalle($sucursal->calle);
            $sucursalObj->setColonia($sucursal->colonia);
            $sucursalObj->setNumero($sucursal->numero);
            $sucursalObj->setCP($sucursal->CP);
            $sucursalObj->setTelefono($sucursal->telefono);

            return $sucursalObj;
        })->toArray();

        return $sucursalesArr;
    }
}
