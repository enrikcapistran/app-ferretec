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

        $sucuralId = session()->get('sucursal')->getIdSucursal();

        if (!auth()->check()) {
            $this->carrito = session()->get('carrito') ?? new CarritoDeCompra(null, $sucuralId);
            session()->put('carrito', $this->carrito);
            return;
        }

        $usuario = auth()->user()->idUsuario;

        $carritoUsuarioSucursal = $this->carritoServicio->obtenerCarrito($usuario, $sucuralId);
        if ($carritoUsuarioSucursal) {
            $this->carrito = new CarritoDeCompra($carritoUsuarioSucursal->idUsuario, $carritoUsuarioSucursal->idSucursal, $carritoUsuarioSucursal->idStatus, $carritoUsuarioSucursal->idCarrito);

            $detalles = $this->detalleCarritoServicio->where('idCarrito', '=', $this->carrito->getIdCarrito())->get();
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
            $this->carrito = new CarritoDeCompra(1, $sucuralId);
            $this->carritoServicio->create([
                'idUsuario' => $usuario,
                'idSucursal' => $sucuralId,
                'idStatus' => 1,
            ]);
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
        //Obtener producto
        $productoJson = ProductoServicio::where('idProducto', '=', $idProducto)->first();
        $productoObj = new Producto(
            $productoJson->idProducto,
            $productoJson->nombreProducto,
            $productoJson->descripcion,
            $productoJson->imagen,
            $productoJson->precioUnitario,
            $productoJson->idTipoProducto,
        );

        // Crear un nuevo detalle de carrito
        $detalle = new DetalleCarrito($this->carrito->getIdCarrito(), $productoObj, $cantidad);

        // Agregar el detalle al carrito
        $this->carrito->addDetalle($detalle);

        //dd($this->carrito);
        if (auth()->check())
            $this->detalleCarritoServicio->create([
                'idCarrito' => $this->carrito->getIdCarrito(),
                'idProducto' => $idProducto,
                'cantidad' => $cantidad,
                'idStatus' => 1,
            ]);

        // Guardar el carrito en la sesión
        session()->put('carrito', $this->carrito);
    }

    public function quitarDelCarrito($idProducto)
    {
        $this->carrito->removeDetalle($idProducto);

        if (auth()->check())
            $this->detalleCarritoServicio->where(['idProducto', '=', $idProducto], ['idCarrito', '=', $this->carrito->getIdCarrito()])->update(['idStatus' => 2]);
    }

    public function actualizarProducto($idProducto, $cantidad)
    {
        $this->carrito->actualizarDetalle($idProducto, $cantidad);

        if (auth()->check())
            $this->detalleCarritoServicio->where('idDetalleCarrito', '=', $idProducto)->update(['cantidad' => $cantidad]);

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
