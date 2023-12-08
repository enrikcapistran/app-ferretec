<?php

namespace App\Models\Modelos;

use App\Models\Clases\Status;
use App\Models\Clases\Producto;

use App\Models\Producto as productoServicios;
use App\Models\InventarioSucursal as inventarioSucursalServicios;
use App\Models\DetalleSurtido as DetalleSurtidoServicios;

class detalleSurtidoModelo
{

    private productoServicios $productoServicios;
    private inventarioSucursalServicios $inventarioSucursalServicios;
    private DetalleSurtidoServicios $DetalleSurtidoServicios;

    public function __construct()
    {

        $this->productoServicios = new productoServicios();
        $this->inventarioSucursalServicios = new inventarioSucursalServicios();
        $this->DetalleSurtidoServicios = new DetalleSurtidoServicios();
    }

    public function guardarInventario(int $idSucursal, int $idRefaccion, int $cantidad)
    {
        $inventario = $this->inventarioSucursalServicios->all()->where('idSucursal', $idSucursal)->where('idProducto', $idRefaccion)->first();

        //dd($inventario);


        if ($inventario) {
            $inventarioSucursal = $this->inventarioSucursalServicios
                ->where('idSucursal', '=', $idSucursal)
                ->where('idProducto', '=', $idRefaccion)
                ->update([
                    'existencia' => $this->inventarioSucursalServicios->where('idSucursal', '=', $idSucursal)
                        ->where('idProducto', '=',  $idRefaccion)
                        ->first()->existencia + $cantidad
                ]);
        } else {
            $this->inventarioSucursalServicios->create([
                'idSucursal' => $idSucursal,
                'idProducto' => $idRefaccion,
                'existencia' => $cantidad
            ]);
        }

        //eliminar detalle surtido
        //$this->DetalleSurtidoServicios->where('idRefaccion', '=', $idRefaccion)->delete();

    }
}
