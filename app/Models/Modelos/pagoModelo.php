<?php

namespace App\Models\Modelos;

use App\Models\Pago as PagoServicio;
use App\Models\LineaDeVenta as LineaDeVentaServicio;
use App\Models\InventarioSucursal as InventarioSucursalServicio;
use App\Models\Venta as VentaServicio;
use App\Models\CarritoDeCompra as CarritoDeCompraServicio;

// use Illuminate\Http\Request;

class pagoModelo
{
    private PagoServicio $PagoServicio;
    private LineaDeVentaServicio $LineaDeVentaServicio;
    private InventarioSucursalServicio $InventarioSucursalServicio;
    private VentaServicio $VentaServicio;
    private CarritoDeCompraServicio $CarritoDeCompraServicio;


    public function __construct()
    {
        $this->PagoServicio = new PagoServicio();
        $this->LineaDeVentaServicio = new LineaDeVentaServicio();
        $this->InventarioSucursalServicio = new InventarioSucursalServicio();
        $this->VentaServicio = new VentaServicio();
        $this->CarritoDeCompraServicio = new CarritoDeCompraServicio();
    }


    public function pagar()
    {
        $carrito = session()->get('carrito');
        $usuarioId = auth()->user()->idUsuario;

        $pago = $this->PagoServicio->create([
            'metodoDePago' => "Pago de prueba",
        ]);

        $venta = $this->VentaServicio->create([
            'idSucursal' => $carrito->getIdSucursal(),
            'idEmpleado' => $usuarioId,
            'idCliente' => $usuarioId,
            'idPago' => $pago->idPago,
            'totalPago' => $carrito->getTotal(),
            'idStatus' => 1,
        ]);

        //dd($venta);

        foreach ($carrito->getDetalles() as $detalle) {
            $this->LineaDeVentaServicio->create([
                'idVenta' => $venta->folio,
                'idProducto' => $detalle->getProducto()->getIdProducto(),
                'cantidad' => $detalle->getCantidad(),
                'precioUnitario' => $detalle->getProducto()->getPrecioUnitario(),
                'subtotal' => $detalle->calcularSubtotal(),
            ]);

            $inventarioSucursal = $this->InventarioSucursalServicio
                ->where('idSucursal', '=', $carrito->getIdSucursal())
                ->where('idProducto', '=', $detalle->getProducto()->getIdProducto())
                ->update([
                    'existencia' => $this->InventarioSucursalServicio->where('idSucursal', '=', $carrito->getIdSucursal())
                        ->where('idProducto', '=', $detalle->getProducto()->getIdProducto())
                        ->first()->existencia - $detalle->getCantidad()
                ]);
        }

        //set carrito status to 2
        $this->CarritoDeCompraServicio->where('idCarrito', '=', $carrito->getIdCarrito())->update([
            'idStatus' => 2
        ]);
        session()->forget('carrito');
    }
}
