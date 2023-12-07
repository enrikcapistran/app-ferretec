<?php

namespace App\Models\Modelos;

use App\Models\Clases\Status;
use App\Models\Clases\Producto;

use App\Models\Producto as productoServicios;

class refaccionModelo
{

    private productoServicios $productoServicios;

    public function __construct()
    {

        $this->productoServicios = new productoServicios();
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
}
