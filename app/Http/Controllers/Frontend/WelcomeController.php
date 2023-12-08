<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $productos = Producto::seleccionarSoloKits()->take(4)->get(); //primeros 4 kits
        //dd($productos);
        //$kits = Kit::all(); // todos los kits

        return view('welcome', ['productos' => $productos]);
    }

    public function gracias()
    {
        return view('gracias');
    }
}
