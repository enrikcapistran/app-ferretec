<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Kit;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //
    public function index()
    {
        $productos = Producto::all();
        $kits = Kit::all();
        return view('productos.index', compact('productos'), compact('kits'));
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function showKit(Kit $kit)
    {
        return view('kits.show', compact('kit'));
    }
}
