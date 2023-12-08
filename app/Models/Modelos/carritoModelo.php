<?php

namespace App\Models\Modelos;

use App\Models\Clases\CarritoDeCompra;
use App\Models\Clases\DetalleCarrito;
use App\Models\Clases\Producto;

use App\Models\CarritoDeCompra as CarritoDeCompraServicio;
use App\Models\DetalleCarrito as DetalleCarritoServicio;
use App\Models\Producto as ProductoServicio;

// use Illuminate\Http\Request;

class CarritoModelo
{
    private CarritoDeCompra $carrito;
    private CarritoDeCompraServicio $carritoServicio;
    private DetalleCarritoServicio $detalleCarritoServicio;
    private ProductoServicio $ProductoServicio;


    public function __construct()
    {
        // Inicializar el carrito, asumiendo que lo guardas en la sesión
        $this->carritoServicio = new CarritoDeCompraServicio();
        $this->detalleCarritoServicio = new DetalleCarritoServicio();
        $this->ProductoServicio = new ProductoServicio();

        $usuario = 1; //auth()->user()->id;
        $sucural = 1; //session()->get('sucursal');

        $carritoUsuarioSucursal = $this->carritoServicio->obtenerCarrito($usuario, $sucural);
        if ($carritoUsuarioSucursal) {
            $this->carrito = new CarritoDeCompra($carritoUsuarioSucursal->idUsuario, $carritoUsuarioSucursal->idSucursal, $carritoUsuarioSucursal->idStatus, $carritoUsuarioSucursal->idCarrito);

            $detalles = $this->detalleCarritoServicio->all(); //->where('idCarrito', '=', $carritoUsuarioSucursal->idCarrito);
            //dd($detalles);
            foreach ($detalles as $detalle) {
                $productoJson = $this->ProductoServicio->all()->where('idProducto', '=', $detalle->idProducto)->first();
                $producto = new Producto(
                    $productoJson->idProducto,
                    $productoJson->nombreProducto,
                    $productoJson->descripcion,
                    $productoJson->imagen,
                    $productoJson->precioUnitario,
                    $productoJson->idTipoProducto,
                );

                $this->carrito->addDetalle(new DetalleCarrito($detalle->idCarrito, $producto, $detalle->cantidad, $detalle->idDetalleCarrito));
            }
        } else {
            $this->carrito = new CarritoDeCompra(1, $sucural);
        }

        session()->put('carrito', $this->carrito);
    }

    public function vaciarCarrito()
    {
        // Implementar la lógica para vaciar el carrito
        // ...
    }

    public function agregarAlCarrito($idProducto, $cantidad)
    {
        // Crear un nuevo detalle de carrito
        $detalle = new DetalleCarrito($this->carrito->getIdCarrito(), $idProducto, $cantidad);

        // Agregar el detalle al carrito
        $this->carrito->addDetalle($detalle);

        // Guardar el carrito en la sesión
        session()->put('carrito', $this->carrito);
    }

    public function quitarDelCarrito($idProducto)
    {
        $this->carrito->removeDetalle($idProducto);

        $this->detalleCarritoServicio->where('idDetalleCarrito', '=', $idProducto)->delete();
    }

    public function actualizarProducto($idDetalleCarrito, $cantidad)
    {
        $this->carrito->actualizarDetalle($idDetalleCarrito, $cantidad);

        $this->detalleCarritoServicio->where('idDetalleCarrito', '=', $idDetalleCarrito)->update(['cantidad' => $cantidad]);

        session()->put('carrito', $this->carrito);



        //dd($this->carrito);
    }

    public function pagar()
    {
        // Lógica para procesar el pago
        // Por ahora, es un método vacío como se solicitó
    }

    public function seleccionarCliente($idUsuario)
    {
        // Método vacío para uso futuro
    }

    public function obtenerCarrito(): CarritoDeCompra
    {

        return $this->carrito;
    }
}
