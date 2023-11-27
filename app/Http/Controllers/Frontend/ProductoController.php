<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //
    public function index(){
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function show(Refaccion $refaccion){
        return view('productos.show', compact('producto'));
    }
}

