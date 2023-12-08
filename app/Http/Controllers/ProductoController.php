<?php

namespace App\Http\Controllers;

use App\Models\ProductoModelo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ProductoController extends Controller
{
    protected $ProductoModelo;

    public function index()
    {
        $producto = $this->ProductoModelo->index();
        return view('productos.index', compact('Producto'));
    }

    public function show($id)
    {
        $producto = $this->ProductoModelo->buscar($id);

        if (!$producto) {
            abort(404, 'Producto no encontrado');
        }
        return view('Producto.show', compact('Producto'));
    }
}