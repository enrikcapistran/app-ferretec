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
}
