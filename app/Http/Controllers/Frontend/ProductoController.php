<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kit;
use Illuminate\Http\Request;

use App\Models\Modelos\kitModelo;
use App\Models\Modelos\refaccionModelo;

use App\Models\Producto;



class ProductoController extends Controller
{
    //
    public function index()
    {
        //$kitModelo = new kitModelo();
        $productosModelo = new refaccionModelo();

        $productos = $productosModelo->getProductosPorSucursalYStock();

        return view('productos.index', compact('productos'));
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function showKit(Kit $kit)
    {
        return view('kits.show', compact('kit'));
    }

    public function buscarProductos(Request $request)
    {
        // Validar la entrada del usuario (opcional)
        $request->validate([
            'query' => 'required|string|min:3', // Requiere al menos 3 caracteres en la consulta
        ]);

        // Obtener la consulta desde la solicitud
        $query = $request->input('query');

        // Realizar la búsqueda utilizando el método estático en el modelo
        $resultados = Producto::buscar($query);

        // Retornar la vista con los resultados de la búsqueda
        return view('productos.resultados', compact('resultados'));
    }
}
