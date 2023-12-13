<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    public function buscarProductos(Request $request)
    {
        // Lógica de búsqueda aquí...

        // Puedes acceder al término de búsqueda con $request->input('query')
        $query = $request->input('query');

        // Implementa tu lógica de búsqueda y devuelve los resultados
        // ...

        // Ejemplo de retorno de resultados (puedes ajustar según tus necesidades)
        $resultados = Producto::where('nombreProducto', 'like', "%$query%")->get();

        // Si no estás autenticado, puedes manejarlo de manera diferente
        if (auth()->check()) {
            return view('productos.resultados', compact('resultados'));
        } else {
            return view('productos.resultados_publico', compact('resultados'));
            // Puedes crear una vista diferente para resultados de búsqueda para usuarios no autenticados
        }
    }
}