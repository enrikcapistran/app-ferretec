<?php

namespace App\Models\Modelos;

use App\Models\Clases\Status;
use App\Models\Clases\Producto;

use App\Models\Producto as productoServicios;
use App\Models\InventarioSucursal as inventarioSucursalServicios;
use App\Models\DetallesPedidosSurtidos as DetalleSurtidoServicios;

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
    
}