<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoDeCompraController extends Controller
{
    public function index()
    {
        // Obtener los productos del carrito desde la sesión
        $carrito = session()->get('carrito', []);

        // Puedes pasar los productos a una vista
        return view('carrito.index', ['productos' => $carrito]);
    }

    public function agregar(Producto $producto)
    {
        // Obtener el carrito actual desde la sesión
        $carrito = session()->get('carrito', []);

        // Verificar si el producto ya está en el carrito
        if (isset($carrito[$producto->id])) {
            // Incrementar la cantidad si ya está en el carrito
            $carrito[$producto->id]['cantidad']++;
        } else {
            // Agregar el producto al carrito
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
            ];
        }

        // Guardar el carrito en la sesión
        session()->put('carrito', $carrito);

        // Puedes redirigir a la página del carrito o a la página del producto según tus necesidades
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    // Otros métodos según sea necesario
}