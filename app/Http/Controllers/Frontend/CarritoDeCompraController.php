<?php

namespace App\Http\Controllers\Frontend;

//CLASES

//MODELOS
use App\Models\Modelos\CarritoModelo;

use App\Http\Controllers\Controller;
use App\Models\Producto;

use Illuminate\Http\Request;

class CarritoDeCompraController extends Controller
{
    public function index()
    {
        // Obtener los productos del carrito desde la sesión
        $carritoModelo = new CarritoModelo();
        $carrito = $carritoModelo->obtenerCarrito();

        //dd($carrito);

        // Puedes pasar los productos a una vista
        return view('carrito.index', compact('carrito'));
    }

    public function agregar(int $idProducto, int $cantidad)
    {
        // Obtener el carrito actual desde la sesión
        $carrito = session()->get('carrito');

        // Crear un nuevo detalle de carrito
        $carritoModelo = new CarritoModelo();
        $carritoModelo->agregarAlCarrito($idProducto, $cantidad);


        // Guardar el carrito en la sesión
        session()->put('carrito', $carrito);

        // Puedes redirigir a la página del carrito o a la página del producto según tus necesidades
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function seleccionarCliente()
    {
    }

    public function pagar()
    {
    }

    public function actualizarProducto(Request $request, int $idDetalleCarrito)
    {
        $carritoModelo = new CarritoModelo();
        $carritoModelo->actualizarProducto($idDetalleCarrito, $request->cantidad);

        session()->put('carrito', $carritoModelo->obtenerCarrito());

        return redirect()->back()->with('success', 'Producto actualizado');
    }

    public function quitarProducto(int $idDetalleCarrito)
    {
        $carritoModelo = new CarritoModelo();
        $carritoModelo->quitarDelCarrito($idDetalleCarrito);

        session()->put('carrito', $carritoModelo->obtenerCarrito());

        return redirect()->back()->with('success', 'Producto quitado');
    }

    public function vaciarCarrito()
    {
    }

    public function agregarProducto()
    {
    }

    // Otros métodos según sea necesario
}
