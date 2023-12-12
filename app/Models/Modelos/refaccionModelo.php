<?php

namespace App\Models\Modelos;

use App\Models\Clases\Status;
use App\Models\Clases\Producto;

use App\Models\Producto as productoServicios;
use App\Models\InventarioSucursal as inventarioSucursalServicios;

class refaccionModelo
{

    private productoServicios $productoServicios;
    private inventarioSucursalServicios $inventarioSucursalServicios;

    public function __construct()
    {

        $this->productoServicios = new productoServicios();
        $this->inventarioSucursalServicios = new inventarioSucursalServicios();
    }

    public function getTodasRefacciones()
    {
        //obtener todas las refacciones con status activo (1)
        $refaccionesJson = $this->productoServicios->all()->where('idTipoProducto', "=", 1)->where('idStatus', 1);
        $refaccionesArray = $refaccionesJson->map(function ($refaccion) {
            $refaccionObj = new Producto(
                $refaccion->idProducto,
                $refaccion->nombreProducto,
                $refaccion->descripcion,
                $refaccion->imagen,
                $refaccion->precioUnitario,
                $refaccion->idTipoProducto,
                new Status($refaccion->status->idStatus, "Activo")
            );

            return $refaccionObj;
        })->toArray();

        return $refaccionesArray;
    }

    public function getProductosPorSucursalYStock()
    {
        $sucursal = session()->get('sucursal');

        $usuario = auth()->user();

        //dd($usuario->idRol);


        $stockJson = $this->inventarioSucursalServicios->all()->where('idSucursal', "=", $sucursal->getIdSucursal())->where('idStatus', 1)->where('existencia', ">", 0);



        //dd($productosJson);

        $productosArray = $stockJson->map(function ($stock) use ($usuario) {
            $producto = $stock->producto()->first();

            if ($producto->idTipoProducto == 2 && (is_null($usuario) || $usuario->idRol != 6)) {
                return null;
            }

            $productoObj = new Producto(
                $producto->idProducto,
                $producto->nombreProducto,
                $producto->descripcion,
                $producto->imagen,
                $producto->precioUnitario,
                $producto->idTipoProducto,
                new Status($producto->status->idStatus, "Activo")
            );

            $productoObj->setStock($stock->existencia);

            return $productoObj;
        })->filter()->toArray();

        return array_values($productosArray);
    }
}
